<?php
require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';


   $dbClass = new DATABASE_CONFIG;
   $dbVars = get_class_vars(get_class($dbClass));
   $dbHost = $dbVars['default']['host'];
   $dbName = $dbVars['default']['database'];
   $dbLogin = $dbVars['default']['login'];
   $dbPassword = $dbVars['default']['password'];
	
	error_reporting(E_ALL ^ E_NOTICE);

	$cakedb = mysql_connect($dbHost, $dbLogin, $dbPassword);
	if (!$cakedb) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbName, $cakedb);

	$op = isset($_POST["op"]) ? $_POST["op"]:"none";

	if($op=="none"){
		echo '<link href="/scripts/style.css" rel="stylesheet" type="text/css" />';
		$sqlStr = "SELECT COUNT(*) AS Total FROM `users` WHERE (status=1 and newsletters=1)  OR ( email_status=1 and status=5 and newsletters=1)";
		$result = mysql_query($sqlStr);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$total = $row['Total'];
		}
		echo "<h1>myDr's Mailing List</h1>";
		echo "<form action='get_mydr_mailinglist.php' method='post'>";
		echo "<input type='hidden' name='op' value='yes' />";
		echo "Total subscribers: ".$total.".  <input type='button' value='Get CSV file...' onclick='submit();'> ";
		echo "</form>";
	}else{
		/* 
			Conditions..
				quick newsletter signup: email_status=1 and status=5 and newsletters=1. 
				normal user: status=1 and newsletters=1
			
		*/
		$sqlStr = "SELECT fname, lname, email, email_status, state, country, gender, type, status, "
			 ."MD5(CONCAT(login, '-', email)) AS  confirm_hash "
			 ." FROM `users` "
			 ." WHERE (status=1 and newsletters=1)  OR ( email_status=1 and status=5 and newsletters=1)";
		$datedfname = "myDrMailinglist_".date("dMY").".csv";
		$res = query_to_csv($cakedb, $sqlStr, $datedfname, true);
		//echo "Total subscribers: ".count();
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
       
        $result = mysql_query($query, $db_conn) or die( mysql_error( $db_conn ) );
       
        if($headers) {
            // output header row (if at least one row exists)
            $row = mysql_fetch_assoc($result);
            if($row) {
                fputcsv($fp, array_keys($row));
                // reset pointer back to beginning
                mysql_data_seek($result, 0);
            }
        }
       
        while($row = mysql_fetch_assoc($result)) {
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
