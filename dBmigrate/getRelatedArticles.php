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
              // array("srcfield"=>"id",           "destfield"=>"legacy_id",      "type"=>"int"),
              array("srcfield"=>"id",           "destfield"=>"id",      "type"=>"int"),
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

$tables = ['articles_articles'];
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
  // $sqlGetAll = "SELECT * FROM ".$strSrcTable." ";
  // $sqlGetAll = "SELECT * FROM ".$strTgtTable." WHERE legacy_id IS NOT NULL; ";
  $sqlGetAll = "SELECT * FROM ".$strTgtTable." WHERE id IS NOT NULL; ";
  //$sqlGetAll = "SELECT * FROM ".$strSrcTable." WHERE 1 "." ORDER BY id DESC ";
  echo "\n".$sqlGetAll."\n";
  $allResult = $objTgtDb->query($sqlGetAll);
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
            if($striptags==true){
              $colVals = strip_tags($colVals);
            }

            /* Get Related Articles */
            //echo "\n"."Row: ".$row['title'].", article_id: ".$row['id'].", id: ".$row['source_id'];
            echo "\nAdding related articles: ";
            // if(isset($row['legacy_id'])){
            if(isset($row['id'])){
                // $sql = "select * from articles_linked_articles where article_id=".$row['legacy_id']." ";
                $sql = "select * from articles_linked_articles where article_id=".$row['id']." ";
                echo "\n".$sql."\n";
                $allres = $objSrcDb->query($sql);
                $allids = "";
                $ctr = 0;
                foreach ($allres as $mow) {
                    if($ctr>0){
                      $allids .= ",".$mow['linked_id'];
                    }else{
                      $allids = $mow['linked_id'];
                    }
                    $ctr++;
                }
                if($allids != ""){
                      // $sql = "select * from articles where legacy_id IN (".$allids.") ";
                      $sql = "select * from articles where id IN (".$allids.") ";
                      echo "\n".$sql."\n";
                      $allres = $objTgtDb->query($sql);
                      foreach ($allres as $mow) {
                          $copySql = "INSERT INTO articles_articles (article_id, related_article_id)".
                                      "   VALUES(".$row['id'].",".testForNull($mow['id'])." ".
                                      "         )";
                                      //echo "-->>".$copySql."<<--";
                                      echo "-->>rel_article_id: ".testForNull($mow['id']);
                          if(!$objTgtDb->query($copySql)) {
                              die("\nA MySQL error has occurred!" . $objTgtDb->error);
                          }else{
                              echo "\n"."---> id: ".$mow['id'];
                          }
                      }
                }
            }
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
