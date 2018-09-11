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
       "FROM sections ".
       "LIMIT 0, 10 ";
$result = $mysqlSource->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo $row['name']."\n";
}

$arrFields = array(
              array("srcfield"=>"id",           "destfield"=>"id",          "type"=>"int"),
              array("srcfield"=>"name",        "destfield"=>"name",       "type"=>"string"),
              array("srcfield"=>"url",          "destfield"=>"url",         "type"=>"string"),
              array("srcfield"=>"body",         "destfield"=>"body",        "type"=>"string"),
              array("srcfield"=>"keywords",       "destfield"=>"keywords",      "type"=>"string"),
              array("srcfield"=>"status",       "destfield"=>"status",      "type"=>"int"),
              array("srcfield"=>"created",      "destfield"=>"created",     "type"=>"string"),
              array("srcfield"=>"modified",     "destfield"=>"modified",    "type"=>"string"),
    );
$tables = ['sections', 'sections_tools', 'articles_sections', 'section_slides', 'cmi_products_sections'];
foreach($tables as $table){
    $sql = "TRUNCATE TABLE ".$table." ";
    if(!$mysqlTarget->query($sql)){
      die("\nA MySQL error has occurred!" . $mysqlTarget->error);
    }else{
      echo "\nTable ".$table." truncated...\n";
    }
}

dbTableCopy($mysqlSource, $mysqlTarget, "sections", "sections", $arrFields);






die();

/* dbTableCopy($mysqlSource, $mysqlTarget, "attributes", "cmi_attributes",$fields); */
function dbTableCopy($objSrcDb, $objTgtDb, $strSrcTable, $strTgtTable, $arrFields, $striptags=false){
  $ctr=0;
  $sqlGetAll = "SELECT * FROM ".$strSrcTable;
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
                $colVals .= $sptr."'NULL'";
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
            //echo " ".$strTgtTable.", colVals: [".$colVals."]\n";

            /* Get Sections-Tools */
            //echo "\n"."Row: ".$row['title'].", article_id: ".$row['id'].", id: ".$row['source_id'];
            echo "\nAdding sections_tools: ".$row['url'];
            $sql = "select * from sections_tools where section_id=".$row['id']." ";
            $allres = $objSrcDb->query($sql);
            foreach ($allres as $mow) {
                $copySql = "INSERT INTO sections_tools (section_id, tool_id)".
                            "   VALUES(".$row['id'].",".
                            "          ".$mow['tool_id']." ".
                            "         )";
                            //echo "-->>".$copySql."<<--";
                            echo "_______section_id: ".$mow['section_id'].", tool_id: ".$mow['tool_id'];
                if(!$objTgtDb->query($copySql)) {
                    die("\nA MySQL error has occurred!" . $objTgtDb->error);
                }else{
                    echo "\n"."Successfully added tool[".$mow['tool_id']."] for this Sections ";
                }
            }
            /* END Get Sections-Tools */

            /* Get Sections-Articles top-10 */
            echo "\nAdding top-10 articles: ".$row['url'];
            $sql = "select * from sections_articles where section_id=".$row['id']." ";
            $allres = $objSrcDb->query($sql);
            foreach ($allres as $mow) {
                // $sql2 = "select id from articles where legacy_id=".$mow['article_id']." ";
                $sql2 = "select id from articles where id=".$mow['article_id']." ";
                $res2 = $objTgtDb->query($sql2);
                $row2 = $res2->fetch_array(MYSQLI_ASSOC);
                $copySql = "INSERT INTO articles_sections (article_id, section_id)".
                            "   VALUES(".$row2['id'].",".
                            "          ".$row['id']." ".
                            "         )";
                            //echo "-->>".$copySql."<<--";
                            echo "_______section_id: ".$mow['section_id'].", article_id: ".$row2['id'];
                if(!$objTgtDb->query($copySql)) {
                    die("\nA MySQL error has occurred!" . $objTgtDb->error);
                }else{
                    echo "\n"."Successfully added top-10 article[".$row2['id']."] for this Sections ";
                }
            }
            /* END Sections-Articles top-10 */


            /* Get HeroSlides */
            if($row['id']>1 && $row['id']<29){
                //url, titile, body, main_image, sub_image,
                echo "\nhero1: ".$row['hero1_title'];
                $imageMe1 = str_replace('webroot/files/images/', $GLOBALS["s3_path"]."/files/images/", trim($row['hero1_image']));
                $imageMe2 = str_replace('webroot/files/images/', $GLOBALS["s3_path"]."/files/images/", trim($row['hero2_image']));
                $imageMe3 = str_replace('webroot/files/images/', $GLOBALS["s3_path"]."/files/images/", trim($row['hero3_image']));
                $slide_cols = [
                                "(".$row['id'].",'".$objTgtDb->real_escape_string($row['hero1_url'])."','".$objTgtDb->real_escape_string($row['hero1_title'])."','".$objTgtDb->real_escape_string($imageMe1)."')",
                                "(".$row['id'].",'".$objTgtDb->real_escape_string($row['hero2_url'])."','".$objTgtDb->real_escape_string($row['hero2_title'])."','".$objTgtDb->real_escape_string($imageMe2)."')",
                                "(".$row['id'].",'".$objTgtDb->real_escape_string($row['hero2_url'])."','".$objTgtDb->real_escape_string($row['hero3_title'])."','".$objTgtDb->real_escape_string($imageMe3)."')",
                              ];
                foreach ($slide_cols as $slide) {
                  $copySql = "INSERT INTO section_slides (section_id, url, title, main_image) VALUES".$slide." ";
                  if(!$objTgtDb->query($copySql)) {
                      die("\nA MySQL error has occurred!" . $objTgtDb->error);
                  }else{
                      echo "\n"."Successfully added slides for this Sections ";

                  }
                }

            }
            /* END Get HeroSlides */

            /* Get Medicines/Cmis */
            echo "\nAdding Top Medicines: ";
            if($row['id'] > 1 && $row['id'] < 29){
                $cmiLinks = explode('<|>', $row['body_links']);
                if(count($cmiLinks)>1){
                    foreach ($cmiLinks as $key => $value) {
                            $medlink = explode('~|~', $value);
                            $medfullurl = explode('/', $medlink[1]);
                            $med_url = $medfullurl[count($medfullurl)-1];
                            $findSql = "SELECT id, full_url FROM cmi_products WHERE full_url LIKE '%".$med_url."%' LIMIT 0,1";
                            $allcmi = $objTgtDb->query($findSql);
                            if($allcmi->num_rows != 0){
                                $pow = $allcmi->fetch_array(MYSQLI_ASSOC);
                                if(isset($pow)){
                                      $insertSql = "INSERT INTO cmi_products_sections (cmi_product_id, section_id)".
                                                      " VALUES (".$pow['id'].",".$row['id'].")";
                                      if(!$objTgtDb->query($insertSql)) {
                                          die("\nA MySQL error has occurred!" . $objTgtDb->error);
                                      }
                                }
                            }
                            //echo "\n".$insertSql."\n";
                            // if(!$objTgtDb->query($insertSql)) {
                            //     die("\nA MySQL error has occurred!" . $objTgtDb->error);
                            // }
                    }
                }
            }
            //die();
            /* END Get Medicines/Cmis */

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
