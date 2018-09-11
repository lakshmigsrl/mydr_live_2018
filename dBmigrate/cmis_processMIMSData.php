<?php

$dbHost = "localhost";
$dbLogin = 'root';
$dbPassword = 'password';

$dbSource = 'mims_cmi';
$dbTarget = 'mydr';

$mysqlTarget = new mysqli($dbHost, $dbLogin, $dbPassword, $dbTarget);
if(mysqli_connect_errno()){
printf("Connect failed to Target dB: %s\n", mysqli_connect_error());  //Do not echo anything.
exit();
}
$mysqlSource = new mysqli($dbHost, $dbLogin, $dbPassword, $dbSource);
if(mysqli_connect_errno()){
printf("Connect failed to Source dB: %s\n", mysqli_connect_error());  //Do not echo anything.
exit();
}

/* Test Routine */
/*
$sqlStr = 'SELECT Description FROM cmi_attributes WHERE 1 ';
$result = $mysqlTarget->query($sqlStr);
if($result->num_rows != 0){
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
  echo "\n".$row['Description'];
  }
}
*/
$sql = array(
        //Rename table cmi_products to cmi_products_old for use later to update sections_cmi table. Delete this later after the update.
        'RENAME cmi_products' => 'RENAME TABLE '.$dbTarget.'.cmi_products TO '.$dbTarget.'.cmi_products_old;',
        'CREATE cmi_products table' => 'CREATE TABLE '.$dbTarget.'.cmi_products'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'country_id INT(11), product_type_id INT(11), product_id INT(11), description VARCHAR(1024), '.
                'url_name VARCHAR(255), url VARCHAR(255), full_url VARCHAR(255), '.
                'name_attribute VARCHAR(1024), condition_attribute VARCHAR(1024) '.
        ') ',
        'DROP cmi_attributes' => 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_attributes;',
        'CREATE cmi_attributes table' => 'CREATE TABLE '.$dbTarget.'.cmi_attributes'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'country_id INT(11), attribute_id INT(11), description VARCHAR(2000), selection_type_id INT(11),'.
                'include_in_quick_search INT(11), include_in_advance_search INT(11),'.
                'include_in_identa_quick_search INT(11), include_in_identa_advanced_search INT(11),'.
                'multi_value INT(11), property_value VARCHAR(255), is_numeric INT (11)'.
        ') ',
        'DROP cmi_attribute_values' => 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_attribute_values;',
        'CREATE cmi_attribute_values table' => 'CREATE TABLE '.$dbTarget.'.cmi_attribute_values'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'country_id INT(11), attribute_id INT(11), value_id INT(11), value VARCHAR(1000), sort_order INT(11)'.
        ') ',
        'DROP cmi_issues' => 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_issues;',
        'CREATE cmi_issues table' => 'CREATE TABLE '.$dbTarget.'.cmi_issues'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'issue VARCHAR(255), issue_id VARCHAR(50), data_version INT(11), dat_data_version datetime, copyright VARCHAR(50), dat_release datetime'.
        ') ',
        'DROP cmi_link_product_documents' => 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_link_product_documents;',
        'CREATE cmi_link_product_documents table' => 'CREATE TABLE '.$dbTarget.'.cmi_link_product_documents'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'country_id INT(11), product_type_id INT(11), actual_product_id INT(11), document_name VARCHAR(255), '.
                'doc_type_id INT(11), description VARCHAR(255), url VARCHAR(512), sort_order INT(11)'.
        ') ',
        'DROP cmi_product_attributes' => 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_product_attributes;',
        'CREATE cmi_product_attributes table' => 'CREATE TABLE '.$dbTarget.'.cmi_product_attributes'.
        '('.
                'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '.
                'country_id INT(11), product_type_id INT(11), product_id INT(11), attribute_id INT(11), value_id INT(11), sort_order INT(11)'.
        ') ',
        //'IMPORT from products' => 'CREATE TABLE '.$dbTarget.'.cmi_products SELECT * FROM '.$dbSource.'.products'
        //'IMPORT from productattributes' => 'CREATE TABLE '.$dbTarget.'.cmi_productattributes SELECT * FROM '.$dbSource.'.productattributes',
);

foreach ($sql as $key => $query) {
  echo "\nexecuting: ".$key;
  if (!$mysqlTarget->query($query)) {
    die('A MySQL error has occurred!<br><br>' . $mysqlTarget->error);
  }
}

$arrFields = array("CountryID"=>"int", "ProductTypeID"=>"int", "ProductID"=>"int", "Description"=>"str", "urlName"=>"str");
$targetFields = array("country_id", "product_type_id", "product_id", "description", "url_name",);
dbTableCopy($mysqlSource, $mysqlTarget, "products", "cmi_products",$arrFields, $targetFields);

$arrFields = array("CountryID"=>"int", "AttributeID"=>"int", "Description"=>"str", "SelectionTypeID"=>"int",
  "IncludeInQuickSearch"=>"int", "IncludeInAdvancedSearch"=>"int", "IncludeInIdentaQuickSearch"=>"int", "IncludeInIdentaAdvancedSearch"=>"int",
  "MultiValue"=>"int", "PropertyValue"=>"str", "IsNumeric"=>"int");
$targetFields = array("country_id", "attribute_id", "description", "selection_type_id", "include_in_quick_search", "include_in_advance_search",
  "include_in_identa_quick_search", "include_in_identa_advanced_search", "multi_value", "property_value", "is_numeric");
dbTableCopy($mysqlSource, $mysqlTarget, "attributes", "cmi_attributes",$arrFields, $targetFields);

$arrFields = array("CountryID"=>"int", "AttributeID"=>"int", "ValueID"=>"int", "Value"=>"str", "SortOrder"=>"int");
$targetFields = array("country_id", "attribute_id", "value_id", "value", "sort_order");
dbTableCopy($mysqlSource, $mysqlTarget, "attributevalues", "cmi_attribute_values",$arrFields, $targetFields);

$arrFields = array("issue"=>"str", "IssueID"=>"str", "DataVersion"=>"int", "datDataVersion"=>"str", "Copyright"=>"str", "datRelease"=>"str");
$targetFields = array("issue", "issue_id", "data_version", "dat_data_version", "copyright", "dat_release");
dbTableCopy($mysqlSource, $mysqlTarget, "issue", "cmi_issues",$arrFields, $targetFields);

$arrFields = array("CountryID"=>"int", "ProductTypeID"=>"int", "ActualProductID"=>"int", "DocumentName"=>"str",
  "DocTypeID"=>"int", "Description"=>"str", "SortOrder"=>"int");
$targetFields = array("country_id", "product_type_id", "actual_product_id", "document_name", "doc_type_id", "description", "sort_order");
dbTableCopy($mysqlSource, $mysqlTarget, "linkproductdocument", "cmi_link_product_documents",$arrFields, $targetFields, true);

$arrFields = array("CountryID"=>"int", "ProductTypeID"=>"int", "ProductID"=>"int", "AttributeID"=>"int", "ValueID"=>"int", "SortOrder"=>"int");
$targetFields = array("country_id", "product_type_id", "product_id", "attribute_id", "value_id", "sort_order");
dbTableCopy($mysqlSource, $mysqlTarget, "productattributes", "cmi_product_attributes",$arrFields, $targetFields);


/* Update sections-cmis relation table, cmi_products-sections */
echo "\n\n---------Updating Sections-Cmis (Top Medicines for Sections pages) relations id.-----------\n";
$sql = "SELECT * FROM cmi_products_sections ORDER BY id";
$result = $mysqlTarget->query($sql);
if($result->num_rows !=0 ){
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
     echo "\nsection_id: ".$row['section_id'].", cmi_product_id: ".$row['cmi_product_id'];
     $sql2 = "SELECT cmiOne.id as oneId, cmiOne.description as oneDesc, cmiOne.product_id as onePId, cmiNxt.id as nxtId, cmiNxt.description as nxtDesc, cmiNxt.product_id as nxtPId
              FROM cmi_products_old as cmiOne
                 LEFT JOIN cmi_products as cmiNxt ON cmiNxt.product_id = cmiOne.product_id
              WHERE cmiOne.id = ".$row['cmi_product_id']."
            ";
      $result2 = $mysqlTarget->query($sql2);
      while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
        echo "\n\t\t\toneId: ".$row2['oneId'].", oneProductId: ".$row2['onePId'].", oneDesc: ".$row2['oneDesc'];
        echo "\n\t\t\tnxtId: ".$row2['nxtId'].", nxtProductId: ".$row2['nxtPId'].", nxtDesc: ".$row2['nxtDesc'];
        if($row2['nxtId'] != NULL){
          $sqlUpd = "Update cmi_products_sections SET cmi_product_id=".$row2['nxtId']." WHERE id=".$row['id'];
          if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot update cmi_products_sections table\'s cmi_product_id!<br><br>' . $mysqlTarget->error); }
        }else{
          $sqlDel = "DELETE FROM cmi_products_sections WHERE id=".$row['id'];
          if (!$mysqlTarget->query($sqlDel)) { die('A MySQL error has occurred - Cannot delete cmi_products_sections! <br><br>' . $mysqlTarget->error); }
          echo "\nSkipped-Deleted [".$row2['onePId']."] ".$row2['oneDesc']."... Not available in the new CMI batch...\n";
        }

      }
  }
}
$sqlDrop = 'DROP TABLE IF EXISTS '.$dbTarget.'.cmi_products_old;';
if (!$mysqlTarget->query($sqlDrop)) { die('A MySQL error has occurred - Cannot delete cmi_products_old table! <br><br>' . $mysqlTarget->error); }


/* Generate urls for cmi_products */
$ctr=0;
$sql = "SELECT cp.product_id, cp.url, cp.url_name, cp.description, cpd.document_name, cpd.sort_order, cpd.description as DocDesc
        FROM cmi_products AS cp
        LEFT JOIN cmi_link_product_documents AS cpd ON cp.product_id = cpd.actual_product_id ";
$result = $mysqlTarget->query($sql);
if($result->num_rows != 0){
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $ProductID = $row['product_id'];
        $url = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', $row['url_name']));
        $url = trim(trim($url),'-');
        $cntTot = checkCommonDocumentName($mysqlTarget, $row['url_name'], $row['document_name']);
        if($cntTot>1){
                /* Cannot use description as it will create multiple url with the same documentName. */
                $full_url = $url;
                echo "\nUpdating cmi_products URLs: ProductID[".$row['product_id']."], ".$full_url." (common DocName [".$cntTot."])";
        }else{
                /* Use product description for more seo friendly url. */
                $full_url = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', $row['description']));
                $full_url = trim(trim($full_url),'-');
                echo "\nUpdating cmi_products URLs: ProductID[".$row['product_id']."], ".$full_url;
        }
        $sqlUpd = "Update cmi_products SET url='".$url."', full_url='".$full_url."' WHERE product_id=".$ProductID." ";
        if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot add full_url column!<br><br>' . $mysqlTarget->error); }

        $ctr++;
  }
}

/* Generate urls for cmi_link_product_documents */
$ctr=0;
$sql = "SELECT id, description FROM cmi_link_product_documents ";
$result = $mysqlTarget->query($sql);
if($result->num_rows != 0){
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $cpd_id = $row['id'];
        $url = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', $row['description']));
        $url = trim(trim($url),'-');

        echo "\nUpdating cmi_link_product_documents URLs: description[".$row['id']."], ".$url;
        $sqlUpd = "Update cmi_link_product_documents SET url='".$url."'  WHERE id=".$cpd_id." ";
        if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot update url column!<br><br>' . $mysqlTarget->error); }

        $ctr++;
  }
}


/* Delete akward aranesp entries causeing duplicate pages.
Aranesp sureclick, Aranesp prefilled, Calcium chloride Injection, */
$sqlUpd = "DELETE FROM cmi_products WHERE product_id IN (59100002, 59100003, 23120001) ";
if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot add full_url column!<br><br>' . $mysqlTarget->error); }

$sqlUpd = "DELETE FROM cmi_link_product_documents WHERE actual_product_id IN (59100002, 59100003, 23120001) ";
if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot add full_url column!<br><br>' . $mysqlTarget->error); }


echo "\n";
$mysqlTarget->close();
$mysqlSource->close();

die();

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////Functions////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

function checkCommonDocumentName($objTgtDb, $urlName, $DocumentName){
  $sqlQry = "SELECT * FROM cmi_products, cmi_link_product_documents ".
            " WHERE cmi_products.product_id = cmi_link_product_documents.actual_product_id ".
            "   AND cmi_products.url_name =  '".$urlName."' ".
            "   AND cmi_link_product_documents.document_name = '".$DocumentName."'";
  $res = $objTgtDb->query($sqlQry);
  /*
  echo "\n--------->> ".$res->num_rows."\n";
  if($urlName=="Cadatin"){
  echo "\n".$sqlQry;
  die();
  }
  */
  return $res->num_rows;
}


function dbTableCopy($objSrcDb, $objTgtDb, $strSrcTable, $strTgtTable, $arrFields, $targetFields, $striptags=false){
        $ctr=0;
        $sqlGetAll = "SELECT * FROM ".$strSrcTable." ";
        $allResult = $objSrcDb->query($sqlGetAll);
        //echo "\ncolNames: -->".$colNames."<--\n";
        echo "\n";
        if($allResult->num_rows != 0){
                $colNames = $colVals = $sptr = "";
                foreach($targetFields as $columns){
                        $colNames .= $sptr.$columns;
                        $sptr = ",";
                }
                while($row = $allResult->fetch_array(MYSQLI_ASSOC)){

                        $colVals = $sptr = "";
                        foreach($arrFields as $key => $value){
                                if($value=="str"){
                                      $colVals .= $sptr."'".$objTgtDb->real_escape_string($row[$key])."'";
                                }else{
                                      $colVals .= $sptr.$row[$key];
                                }
                                $sptr = ",";
                        }
                        if($striptags==true){
                                $colVals = strip_tags($colVals);
                        }
                        echo " ".$strTgtTable.", colVals: [".$colVals."]\n";

                        $ctr++;
                        $copySql = "INSERT INTO ".$strTgtTable." (".$colNames.")".
                        "   VALUES(".$colVals.")";
                        if(!$objTgtDb->query($copySql)) {
                                die('A MySQL error has occurred!<br><br>' . $objTgtDb->error);
                        }
                }
        }

}/* END dbTableCopy() */




?>
