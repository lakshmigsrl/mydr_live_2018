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

/* Generate urls for cmi_products */
$ctr=0;
$sql = "SELECT cp.id, cp.product_id, cp.url, cp.url_name, cp.description FROM cmi_products AS cp ";
$result = $mysqlTarget->query($sql);
if($result->num_rows != 0){
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
        echo "\nCMI Product: ".$row['url_name'];
        $ProductID = $row['product_id'];
        $sqlAt = "SELECT cav.value, cav.attribute_id
                  FROM cmi_product_attributes as cpa
                      LEFT JOIN cmi_attribute_values as cav ON cav.value_id = cpa.value_id
                  WHERE cpa.product_id=".$row['product_id'];
        $resAt = $mysqlTarget->query($sqlAt);
        if($resAt->num_rows != 0){
            $nameAttr = "";
            $condAttr = "";
            while($rowAtt = $resAt->fetch_array(MYSQLI_ASSOC)){
                if($rowAtt['attribute_id']==5){
                  $condAttr .= $rowAtt['value']." | ";
                }
                if($rowAtt['attribute_id']==18){
                  $nameAttr .= $rowAtt['value']." | ";
                }
                if($rowAtt['attribute_id']==19){
                  $nameAttr .= $rowAtt['value']." | ";
                }

            }
            $sqlUpd = "UPDATE cmi_products SET name_attribute='".$mysqlTarget->real_escape_string($nameAttr)."', condition_attribute='".
                      $mysqlTarget->real_escape_string($condAttr)."' WHERE id=".$row['id']." ";
            if (!$mysqlTarget->query($sqlUpd)) { die('A MySQL error has occurred - Cannot add attributes column!<br><br>' . $mysqlTarget->error); }
            else { echo "\n"."____Successfully added cmi_product[".$row['url_name']."] name/condition attributes."; }
        }

        $ctr++;
  }
}



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
