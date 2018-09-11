<?php
//require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';


   //$dbClass = new DATABASE_CONFIG;
   //$dbVars = get_class_vars(get_class($dbClass));
   //$dbHost = $dbVars['default']['host'];
   //$dbHostReplica = "replica-mydr-sydney-30g.cmkgdpxv1dch.ap-southeast-2.rds.amazonaws.com";
   //$dbName = $dbVars['default']['database'];
   //$dbLogin = $dbVars['default']['login'];
   //$dbPassword = $dbVars['default']['password'];

   $dbHostReplica = "localhost";
//   $dbHostReplica = "mydrmysql-5-7-11.cmkgdpxv1dch.ap-southeast-2.rds.amazonaws.com";
   $dbName = 'cake_mydr';
   $dbLogin = 'local';
//   $dbLogin = 'mydr_user';
   $dbPassword = 'l0c@l';
//   $dbPassword = 'h#G&^V#^&#U849493jtj)##JFJG0';

	/* Defaults to using replica db, if replica is not accessible, then revert to live. */	
	$cakedb = new mysqli($dbHostReplica, $dbLogin, $dbPassword, $dbName);
	if($cakedb->connect_errno){
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

        // Set necessary headers
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Connection: keep-alive");

	$datedfname = "myDr_Articles_".date("dMY").".csv";
	$fp = fopen($datedfname, 'w');

    //$sqlStr = "SELECT id, section_id, title, url, reviewed, created, status
		$sqlStr = "SELECT articles.id, title, format_type, medical_type, author_id, authors.name as author, source_id, sources.value as source, note, reviewed, status, licensable, page_image
				FROM articles 
            LEFT JOIN authors ON authors.id=articles.author_id 
            LEFT JOIN sources ON sources.id=articles.source_id 
				WHERE status=1 AND section_id IS NOT NULL 
        ORDER BY id DESC ";

		$newArr = array();
        	$result = $cakedb->query($sqlStr);
		$totRows = $result->num_rows;
		$ctr1=0;
		$ctr2=0;
		$strMeds = "";
		while($currRow = $result->fetch_array(MYSQLI_ASSOC)){
			//sleep(1);
			$sqlUrl = "SELECT body, url, section_id FROM articles WHERE id=".$currRow['id']." ";
      $resUrl = $cakedb->query($sqlUrl);
			while($initRow = $resUrl->fetch_array(MYSQLI_ASSOC)){
          $bodyWordCount = str_word_count($initRow['body']);
          $sectionId = $initRow['section_id'];
          $articleUrl = $initRow['url'];
			}

			$sqlUrl = "SELECT * FROM sections WHERE id=".$sectionId." ";
        		$resUrl = $cakedb->query($sqlUrl);
			while($dRow = $resUrl->fetch_array(MYSQLI_ASSOC)){
				$toPush = $currRow;
				$newRow = array_merge($toPush, array('section_url'=>$dRow['url'], 'url'=>'http://www.mydr.com.au/'.$dRow['url'].'/'.$articleUrl, 'word_count' => $bodyWordCount));
				array_push($newArr, $newRow);
			}
			$ctr1++;
			$ctr2++;
			$perc = round(($ctr1/$totRows)*100);
	                $lastId = $_SERVER["HTTP_LAST_EVENT_ID"];
        	        if (isset($lastId) && !empty($lastId) && is_numeric($lastId)) {
                	        $lastId = intval($lastId);
                        	$lastId++;
	                } else {
        	                $lastId = 0;
                	}
	                if($ctr2==10){
				$strMeds .= "[".$currRow['url']."] ";
                	        sendMessage($lastId, $perc, $strMeds);
                        	$lastId++;
	                        $ctr2=0;
				$strMeds = "";
        	        }else{
				$strMeds .= "[".$currRow['url']."], ";
			}

		} /*while($currRow)*/

	$res = array_to_csv($newArr, $datedfname);
        fclose($fp);
	sendMessage($lastId, "finished", "/scripts/misc_scripts/".$datedfname);

	mysql_close($cakedb);
	die();
	
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//  F U N C T I O N S . . .

/* Function to send data in format "ticket:price". */
function sendMessage($id, $ctr, $ticket) {
        echo "id: $id\n";
        echo "data: $ticket:$ctr\n\n";
        ob_flush();
        flush();
}


function query_to_csv($db_conn, $query, $filename, $attachment = false, $headers = true) {
       
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }
       
        $result = $db_conn->query($query);
        if($headers) {
            // output header row (if at least one row exists)
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row) {
                fputcsv($fp, array_keys($row));
                // reset pointer back to beginning
                $result->data_seek(0);
            }
        }
       
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
            fputcsv($fp, $row);
        }
       
        fclose($fp);
	return $result;
}

function array_to_csv($inputArray, $filename, $attachment = false, $headers = true) {
       
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }

	$ctr=0; 
	foreach($inputArray as $row){
        	if($headers and $ctr==0) {
			$ctr=1;
                	fputcsv($fp, array_keys($row));
		}
                fputcsv($fp, $row);
	}
       
        fclose($fp);
	return $result;
}

function make_url($url) {
	$url = trim($url);
	$url = preg_replace("/(&|%26)/", "-", $url);
	$url = preg_replace("/[^a-zA-Z0-9 _-]/", "", $url);
	$url = preg_replace("/( |_)/", "-", $url);
	$url = preg_replace("/--/", "-", $url);
	$url = preg_replace("/\'/", "", $url);
	$url = preg_replace("/\s/", "-", $url);
	$url = preg_replace("/--/", "-", $url);
	return strtolower($url);
}
?>
