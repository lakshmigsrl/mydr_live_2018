<?php

$dbHost = "localhost";
$dbLogin = 'local';
$dbPassword = 'l0c@l';

$dbSource = 'cake_doctor_legacy';
$dbTarget = 'cake_mydr';

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


$sql = "SELECT  * ".
       "FROM footers ".
       "LIMIT 0, 10 ";
$result = $mysqlSource->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo $row['name']."\n";
}

$arrFields = array(
              array("srcfield"=>"id",           "destfield"=>"id",          "type"=>"int"),
              array("srcfield"=>"name",         "destfield"=>"name",       "type"=>"string"),
              array("srcfield"=>"value",        "destfield"=>"value",       "type"=>"string"),
              array("srcfield"=>"created",      "destfield"=>"created",     "type"=>"string"),
              array("srcfield"=>"modified",     "destfield"=>"modified",    "type"=>"string"),
    );
$sql = "TRUNCATE TABLE footers ";
if(!$mysqlTarget->query($sql)){
  die("\nA MySQL error has occurred!" . $mysqlTarget->error);
}else{
  echo "\nTable ".$table." truncated...\n";
}
dbTableCopy($mysqlSource, $mysqlTarget, "footers", "footers", $arrFields);






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
              }else if($field['srcfield']=="format_type"){
                $formats = array('','Animation','Health Story','Illustrated Article','News','Special Feature','Standard Article','Disease Index','Mandatory','Fast Facts','Quiz','Health Tools','Risk Assessment','Event','Slideshow','Video');
                $colVals .= $sptr."'".$formats[$row[$field['srcfield']]]."'";
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
            $copySql = "INSERT INTO ".$strTgtTable." (".$colNames.")".
                        "   VALUES(".$colVals.")";
            echo "\n".$copySql."\n";
            if(!$objTgtDb->query($copySql)) {
              die("\nA MySQL error has occurred!" . $objTgtDb->error);
            }
            //*/
            //if($ctr>5) break;
       }
  }

}/* END dbTableCopy() */


?>
