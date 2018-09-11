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
       "FROM articles ".
       "LIMIT 0, 10 ";
$result = $mysqlSource->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo $row['title']."\n";
}

$arrFields = array(
              //array("srcfield"=>"id",           "destfield"=>"legacy_id",      "type"=>"int"),
              array("srcfield"=>"id",           "destfield"=>"id",             "type"=>"int"),
              array("srcfield"=>"title",        "destfield"=>"title",          "type"=>"string"),
              array("srcfield"=>"url",          "destfield"=>"url",            "type"=>"string"),
              array("srcfield"=>"description",  "destfield"=>"abstract",       "type"=>"string"),
              array("srcfield"=>"body",         "destfield"=>"body",           "type"=>"string"),
              array("srcfield"=>"main_image",   "destfield"=>"main_image",     "type"=>"string"),
              array("srcfield"=>"format_type",  "destfield"=>"format_type",    "type"=>"string"),
              array("srcfield"=>"medical_type", "destfield"=>"medical_type",   "type"=>"string"),
              array("srcfield"=>"pub_status",   "destfield"=>"status",         "type"=>"int"),
              array("srcfield"=>"section_id",   "destfield"=>"section_id",     "type"=>"int"),
              array("srcfield"=>"author_id",    "destfield"=>"author_id",      "type"=>"int"),
              array("srcfield"=>"footer_id",    "destfield"=>"footer_id",      "type"=>"int"),
              array("srcfield"=>"audience",     "destfield"=>"audience",       "type"=>"int"),
              array("srcfield"=>"hi_status",    "destfield"=>"hi_status",      "type"=>"int"),
              array("srcfield"=>"gender",       "destfield"=>"content_gender", "type"=>"int"),
              array("srcfield"=>"licensable",   "destfield"=>"licensable",     "type"=>"int"),
              array("srcfield"=>"reference",    "destfield"=>"reference",      "type"=>"string"),
              array("srcfield"=>"notes",         "destfield"=>"note",           "type"=>"string"),
              array("srcfield"=>"review",       "destfield"=>"next_review",    "type"=>"string"),
              array("srcfield"=>"reviewed",     "destfield"=>"reviewed",       "type"=>"string"),
              array("srcfield"=>"created",      "destfield"=>"created",        "type"=>"string"),
              array("srcfield"=>"modified",     "destfield"=>"modified",       "type"=>"string"),
    );

$tables = ['articles', 'article_logs'];
foreach($tables as $table){
    $sql = "TRUNCATE TABLE ".$table." ";
    if(!$mysqlTarget->query($sql)){
      die("\nA MySQL error has occurred!" . $mysqlTarget->error);
    }else{
      echo "\nTable ".$table." truncated...\n";
    }
}

dbTableCopy($mysqlSource, $mysqlTarget, "articles", "articles", $arrFields);






die();


/* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */
/* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */
/* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */ /* Functions */

/* dbTableCopy($mysqlSource, $mysqlTarget, "attributes", "cmi_attributes",$fields); */
function dbTableCopy($objSrcDb, $objTgtDb, $strSrcTable, $strTgtTable, $arrFields, $striptags=false){
  $ctr=0;
  $sqlGetAll = "SELECT * FROM ".$strSrcTable." ";
  //$sqlGetAll = "SELECT * FROM ".$strSrcTable." WHERE 1 "." ORDER BY id DESC ";
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
            echo "\n[".$row['id']."] ".$row['title'];
            $colVals = "";
            $sptr = "";
            foreach($arrFields as $field){
              if($row[$field['srcfield']]==NULL){
                    $colVals .= $sptr."NULL";
              }else if($field['srcfield']=="format_type"){
                    $formats = array('','animation','health_story','illustrated_article','news','special_feature','standard_article','disease_index','mandatory','fast_facts','quiz','health_tools','risk_assessment','event','slideshow','video');
                    $colVals .= $sptr."'".$formats[$row[$field['srcfield']]]."'";
              }else if($field['srcfield']=="main_image"){
                    //$dPathOffset = "lino/";
                    // $dPathOffset = "/var/www/prod/mydr-cake3/app/webroot/";
                    // $sPath = $row[$field['srcfield']];
                    // $dPath = substr($sPath, 0, strrpos($sPath, "/"));
                    // echo "\nsrc: ".$sPath.", dest: ".$dPath."";

                    // if (!is_dir($dPathOffset.$dPath)) {
                    //   mkdir($dPathOffset.$dPath, 0777, true);
                    // }
                    // if (!file_exists($dPath)) {
                    //   copy("old_mydr_files".$sPath, $dPathOffset.$sPath);
                    // }

                    $s3_path_image = $GLOBALS["s3_path"].str_replace('webroot', '', trim($row[$field['srcfield']]));
                    $colVals .= $sptr."'".$objTgtDb->real_escape_string($s3_path_image)."'";
                    //echo "\n-->".$s3_path_image."<--\n";
              }else if($field['srcfield']=="medical_type"){
                        $mediType = validateMedicalType($row[$field['srcfield']]);
                        echo "\nmediType: ".$mediType.", code: ".$row[$field['srcfield']]."";
                        $colVals .= $sptr."'".$mediType."'";
              }else if($field['srcfield']=="body"){
                    $bodyMe = str_replace('/files/images/', $GLOBALS["s3_path"]."/files/images/", trim($row[$field['srcfield']]));
                    $colVals .= $sptr."'".$objTgtDb->real_escape_string($bodyMe)."'";
              }else if($field['type']=="string"){
                    $colVals .= $sptr."'".$objTgtDb->real_escape_string($row[$field['srcfield']])."'";
              }else{
                    $colVals .= $sptr.$row[$field['srcfield']];
              }
              $sptr = ",";
            } /* END foreach */

            if($striptags==true){
              $colVals = strip_tags($colVals);
            }

            //echo "\n".$copySql."\n";
            $copySql = "INSERT INTO ".$strTgtTable." (".$colNames.")".
                        "   VALUES(".$colVals.")";
            ///*
            if(!$objTgtDb->query($copySql)) {
              die("\nA MySQL error has occurred!" . $objTgtDb->error);
            }else{
              $this_article_id = $objTgtDb->insert_id;
              echo "\nlast ID: ".$this_article_id." \n";
            }
            //*/

            /* Get Article Logs */
            //echo "\n"."Row: ".$row['title'].", article_id: ".$row['id'].", id: ".$row['source_id'];
            echo "\nAdding article_logs: ";
            $sql = "select * from article_logs where article_id=".$row['id']." ";
            $allres = $objSrcDb->query($sql);
            foreach ($allres as $mow) {
                $logType = validateArticleLog($mow['article_log_type_id']);

                $sqluser = "select id from contributors where legacy_user_id=".testForNull($mow['source_id'])." ";
                echo "\n".$sqluser."\n";
                $resuser = $objTgtDb->query($sqluser);
                $cow = $resuser->fetch_array(MYSQLI_ASSOC);

                $copySql = "INSERT INTO article_logs (article_id, log_type, contributor_id, date, notes, created)".
                            "   VALUES(".$this_article_id.",'".$logType."',".testForNull($cow['id'], true).",".
                            "           '".testForNull($mow['date'])."','".$objTgtDb->real_escape_string($mow['entry'])."',".
                            "           '".testForNull($mow['created'])."'".
                            "         )";
                            //echo "-->>".$copySql."<<--";
                            echo "-->>source_id/contributor_id: ".testForNull($mow['source_id']).", logtype: ".$logType;
                if(!$objTgtDb->query($copySql)) {
                    die("\nA MySQL error has occurred!" . $objTgtDb->error);
                }else{
                    echo "\n"."---> id: ".$mow['id'];
                }
            }
            /* END Get Article Logs */

            /* Get Related Articles */
              // Should be on a separate script as articles IDs have already changed.
            /* END Get Related Articles */




            echo "\n";
            $ctr++;
            //if($ctr>15) break;
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


//validateArticleLog($mow['article_log_type_id']);
function validateArticleLog($rawLogType)
{
      switch($rawLogType){
        case 1: $logType = "clinical_review"; break;
        case 2: $logType = "editorial_review"; break;
        case 3: $logType = "image_add"; break;
        case 4: $logType = "image_amend"; break;
        case 5: $logType = "image_delete"; break;
        case 6: $logType = "minor_update_editorial"; break;
        case 7: $logType = "minor_update_rx"; break;
        case 8: $logType = "original_input"; break;
        case 9: $logType = "original_write"; break;
        case 10: $logType = "proofread"; break;
        case 11: $logType = "taking_in_cr_amends"; break;
        case 12: $logType = "treatment_major_review"; break;
        case 13: $logType = "managing_ed_approval"; break;
        default: $logType = "Unspecified";
      }
      return $logType;
}

function validateMedicalType($rawMedicalType)
{
      switch($rawMedicalType){
        case 1: $medType = "anatomy"; break;
        case 2: $medType = "all_about_your_condition"; break;
        case 3: $medType = "medical_tests"; break;
        case 4: $medType = "nutrition"; break;
        case 5: $medType = "symptoms"; break;
        case 6: $medType = "treatments"; break;
        case 7: $medType = "exercise_fitness"; break;
        case 8: $medType = "pharmacy_self_care"; break;
        default: $medType = "Unspecified";
      }
      return $medType;
}



?>
