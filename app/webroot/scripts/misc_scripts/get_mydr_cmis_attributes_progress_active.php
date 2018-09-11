<?php
require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';


   $dbClass = new DATABASE_CONFIG;
   $dbVars = get_class_vars(get_class($dbClass));
   $dbHost = $dbVars['default']['host'];
   $dbHostReplica = "replica-mydr-sydney-30g.cmkgdpxv1dch.ap-southeast-2.rds.amazonaws.com";
   $dbName = $dbVars['default']['database'];
   $dbLogin = $dbVars['default']['login'];
   $dbPassword = $dbVars['default']['password'];

	/* Defaults to using replica db, if replica is not accessible, then revert to live. */	
	$cakedb = new mysqli($dbHostReplica, $dbLogin, $dbPassword, $dbName);
	if($cakedb->connect_errno){
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

        // Set necessary headers
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Connection: keep-alive");

	$datedfname = "myDr_CMIs_".date("dMY").".csv";
	$fp = fopen($datedfname, 'w');

		//$sqlStr = "SELECT LPD.DocumentName as CMI_Code, product.urlName AS Name, product.Description, "
		//	 ."	CONCAT('http://www.mydr.com.au/medicines/cmis/', product.full_url) AS  URL "
		//	 ."FROM cmi_products AS product ".
		//	 ."	LEFT JOIN cmi_linkproductdocument AS LPD ON LPD.ActualProductID = product.ProductID ";
		$sqlStr = "SELECT product.ProductID, product.urlName AS Name,  "
			 ."	CONCAT('http://www.mydr.com.au/medicines/cmis/', product.full_url) AS  URL "
			 ."FROM cmi_products AS product "
			 ."GROUP BY product.url "
//			 ."ORDER BY Name ";
			 ."ORDER BY Name LIMIT 100,200";

		$newArr = array();
        	$result = $cakedb->query($sqlStr);
		$totRows = $result->num_rows;
		$ctr1=0;
		$ctr2=0;
		$strMeds = "";
		while($currRow = $result->fetch_array(MYSQLI_ASSOC)){
			$sqlUrl = "SELECT lpd.DocumentName as cmi_code, lpd.Description as iDesc, lpd.DocumentName, ".
				"	GROUP_CONCAT(cav.Value) AS GenericIngredient, ".
				"	GROUP_CONCAT(cav2.Value) AS IndicationAction ".
				"FROM cmi_linkproductdocument AS lpd  ".
				"    LEFT JOIN cmi_productattributes as cpa on cpa.ProductID=lpd.ActualProductID ".
				"    LEFT JOIN cmi_attributevalues as cav on cav.ValueID=cpa.ValueID AND cav.AttributeID=18 ".
				"    LEFT JOIN cmi_attributevalues as cav2 on cav2.ValueID=cpa.ValueID AND cav2.AttributeID=5 ".
				"WHERE lpd.ActualProductID=".$currRow['ProductID']." ".
				"GROUP BY lpd.DocumentName ";
        		$resUrl = $cakedb->query($sqlUrl);
			$resUrl_numRows = $resUrl->num_rows;
			$omitChars = array(' ', '/', '%', '\'', '&', '(', ')', '[', ']', ':', ';');
			while($dRow = $resUrl->fetch_array(MYSQLI_ASSOC)){
				$toPush = $currRow;
				if($resUrl_numRows>1){
					$multicmiUrl = str_replace('-', '', trim($dRow['iDesc']));
					$multicmiUrl = str_replace(' ', '-', $multicmiUrl);
					$multicmiUrl = str_replace($omitChars, '', $multicmiUrl);
					$multicmiUrl = str_replace('amp;', 'and', $multicmiUrl);
					$toPush['URL'] = $toPush['URL']."/".strtolower($multicmiUrl);
					
				}
				$newRow = array_merge($toPush, 
						array('URL'=>$toPush['URL'], 'cmi_code'=>$dRow['cmi_code'], 
							'GenericIngredient'=>$dRow['GenericIngredient'],
							'IndicationAction'=>$dRow['IndicationAction']));
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
				$strMeds .= "[".$currRow['Name']."] ";
                	        sendMessage($lastId, $perc, $strMeds);
                        	$lastId++;
	                        $ctr2=0;
				$strMeds = "";
        	        }else{
				$strMeds .= "[".$currRow['Name']."], ";
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
