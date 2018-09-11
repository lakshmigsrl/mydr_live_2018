<?php

$dbHost = "localhost";
$dbLogin = 'root';
$dbPassword = 'password';
// $dbLogin = 'local';
// $dbPassword = 'l0c@l';

$dbSource = 'mydr_legacy';
$dbTarget = 'mydr';
// $dbSource = 'cake_doctor_legacy';
// $dbTarget = 'mydr_qastaging';

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


// $sql = "SELECT  * ".
//        "FROM therapeutic_links ".
//        "LIMIT 0, 10 ";
// $result = $mysqlSource->query($sql);
// while($row = $result->fetch_array(MYSQLI_ASSOC)){
//     echo $row['name']."\n";
// }

$arrFields = array(
              array("srcfield"=>"attributevalue_id",      "destfield"=>"attribute_value_id",      "type"=>"int"),
              array("srcfield"=>"attribute_name",         "destfield"=>"attribute_name",          "type"=>"string"),
              array("srcfield"=>"attribute_common_name",  "destfield"=>"attribute_common_name",   "type"=>"string"),
              array("srcfield"=>"article_id_list",       "destfield"=>"article_id_list",        "type"=>"string")
    );

$sql = "TRUNCATE TABLE therapeutic_links ";
if(!$mysqlTarget->query($sql)){
  die("\nA MySQL error has occurred!" . $mysqlTarget->error);
}else{
  echo "\nTable ".$table." truncated...\n";
}
dbTableCopy($mysqlSource, $mysqlTarget, "therapeutic_links", "therapeutic_links", $arrFields);






die();
/* dbTableCopy($mysqlSource, $mysqlTarget, "attributes", "cmi_attributes",$fields); */
function dbTableCopy($objSrcDb, $objTgtDb, $strSrcTable, $strTgtTable, $arrFields, $striptags=false){
  $ctr=0;
  $sqlGetAll = "SELECT * FROM ".$strSrcTable." ";
  $allResult = $objSrcDb->query($sqlGetAll);
  //echo "\ncolNames: -->".$colNames."<--\n";
  echo "\n";
  if($allResult->num_rows != 0){
       $colNames = $colVals = $sptr = "";
       foreach($arrFields as $field){
            $colNames .= $sptr.$field['destfield'];
            $sptr = ",";
       }
       while($row = $allResult->fetch_array(MYSQLI_ASSOC)){
            $colVals = "";
            $sptr = "";
            foreach($arrFields as $field){
                  if($row[$field['srcfield']]==NULL){
                    $colVals .= $sptr."NULL";
                  }else if($field['type']=="string"){
                    $colVals .= $sptr."'".$objTgtDb->real_escape_string($row[$field['srcfield']])."'";
                  }else{
                    $colVals .= $sptr.$row[$field['srcfield']];
                  }
                  $sptr = ",";
            }
            if($striptags==true){
                  $colVals = strip_tags($colVals);
            }
            echo " ".$strTgtTable.", colVals: [".$colVals."]\n";

            $ctr++;
            ///*
            $copySql = "INSERT INTO ".$strTgtTable." (".$colNames.", modified, created)".
                        "   VALUES(".$colVals.", NOW(), NOW())";
            echo "\n".$copySql."\n";
            if(!$objTgtDb->query($copySql)) {
              die("\nA MySQL error has occurred!" . $objTgtDb->error);
            }
            //*/
            //if($ctr>5) break;
       }
  }

}/* END dbTableCopy() */


function testForNull($rowData, $isString=false)
{
    if($rowData==NULL){
      if($isString==true){
        return "'NULL'";
      }else{
        return "NULL";
      }
    }
    return $rowData;
}

?>
