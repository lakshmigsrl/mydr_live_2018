<?php

$dbHost = "localhost";
$dbLogin = 'local';
$dbPassword = 'l0c@l';

$dbSource = 'cake_doctor_legacy';
$dbTarget = 'cake_mydr';

$s3_path = "https://s3-ap-southeast-2.amazonaws.com/cirrusdevteam/files_images";
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
       "FROM tools ".
       "LIMIT 0, 10 ";
$result = $mysqlSource->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo $row['id'].", ".$row['title']."\n";
}

$arrFields = array(
              array("srcfield"=>"id",                 "destfield"=>"id",                  "type"=>"int"),
              array("srcfield"=>"title",              "destfield"=>"title",               "type"=>"string"),
              array("srcfield"=>"url",                "destfield"=>"url",                 "type"=>"string"),
              array("srcfield"=>"body",               "destfield"=>"body",                "type"=>"string"),
              array("srcfield"=>"description",        "destfield"=>"description",         "type"=>"string"),
              array("srcfield"=>"reference",          "destfield"=>"reference",           "type"=>"string"),
              array("srcfield"=>"status",             "destfield"=>"status",              "type"=>"int"),
              array("srcfield"=>"author_id",          "destfield"=>"author_id",           "type"=>"int"),
              array("srcfield"=>"publisher_id",       "destfield"=>"publisher_id",        "type"=>"int"),
              array("srcfield"=>"image",              "destfield"=>"image",               "type"=>"string"),
              array("srcfield"=>"reviewed",           "destfield"=>"reviewed",            "type"=>"string"),
              array("srcfield"=>"created",            "destfield"=>"created",             "type"=>"string"),
              array("srcfield"=>"modified",           "destfield"=>"modified",            "type"=>"string"),
    );

$tables = ['tools'];
foreach($tables as $table){
    $sql = "TRUNCATE TABLE ".$table." ";
    if(!$mysqlTarget->query($sql)){
      die("\nA MySQL error has occurred!" . $mysqlTarget->error);
    }else{
      echo "\nTable ".$table." truncated...\n";
    }
}
dbTableCopy($mysqlSource, $mysqlTarget, "tools", "tools", $arrFields);






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
              }else if($field['srcfield']=="body"){
                    $bodyMe = str_replace('/files/images/', $GLOBALS["s3_path"]."/files/images/", trim($row[$field['srcfield']]));
                    $colVals .= $sptr."'".$objTgtDb->real_escape_string($bodyMe)."'";
              }else if($field['type']=="string"){
                $colVals .= $sptr."'".$objTgtDb->real_escape_string($row[$field['srcfield']])."'";
              }else{
                $colVals .= $sptr.$row[$field['srcfield']];
              }
              $sptr = ",";

              if($field['srcfield']=="title"){
                echo " ".$strTgtTable.", colVals: [".$colVals."]\n";
              }
            }

            if($striptags==true){
              $colVals = strip_tags($colVals);
            }
            //echo " ".$strTgtTable.", colVals: [".$colVals."]\n";

            $ctr++;
            ///*
            $copySql = "INSERT INTO ".$strTgtTable." (".$colNames.")".
                        "   VALUES(".$colVals.")";
            //echo "\n".$copySql."\n";
            if(!$objTgtDb->query($copySql)) {
              die("\nA MySQL error has occurred!" . $objTgtDb->error);
            }
            //*/
            //if($ctr>5) break;
       }
  }

}/* END dbTableCopy() */


?>
