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

	$op = isset($_POST["op"]) ? $_POST["op"]:"none";
	if($op=="none"){
		echo '<link href="/scripts/style.css" rel="stylesheet" type="text/css" />';
		$sqlStr = "SELECT COUNT(*) AS Total FROM cmi_products";
		$result = $cakedb->query($sqlStr);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$total = $row['Total'];
		}
		echo "<h1>myDr CMIs list with Attributes</h1>";
		echo "<form action='get_mydr_cmis_attributes.php' method='post'>";
		echo "<input type='hidden' name='op' value='yes' />";
		echo "Total subscribers: ".$total.".  <input type='button' value='Get CSV file...' onclick='submit();'> ";
		echo "</form>";
	}else{
		//$sqlStr = "SELECT LPD.DocumentName as CMI_Code, product.urlName AS Name, product.Description, "
		//	 ."	CONCAT('http://www.mydr.com.au/medicines/cmis/', product.full_url) AS  URL "
		//	 ."FROM cmi_products AS product ".
		//	 ."	LEFT JOIN cmi_linkproductdocument AS LPD ON LPD.ActualProductID = product.ProductID ";
		$sqlStr = "SELECT product.ProductID, product.urlName AS Name,  "
			 ."	CONCAT('http://www.mydr.com.au/medicines/cmis/', product.full_url) AS  URL "
			 ."FROM cmi_products AS product "
			 ."GROUP BY product.url "
			 ."ORDER BY Name ";
		$datedfname = "myDr_CMIs_".date("dMY").".csv";

		$newArr = array();
        	$result = $cakedb->query($sqlStr);
		$totRows = $result->num_rows;
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
		}

		//$res = query_to_csv($cakedb, $sqlStr, $datedfname, true);
		$res = array_to_csv($newArr, $datedfname, true);
	}

	mysql_close($cakedb);

	die();
	
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//  F U N C T I O N S . . .

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
