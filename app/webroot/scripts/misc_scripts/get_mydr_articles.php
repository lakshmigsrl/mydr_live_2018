<?php
//require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';


   //$dbClass = new DATABASE_CONFIG;
   //$dbVars = get_class_vars(get_class($dbClass));
   $dbHost = $dbVars['default']['host'];
   $dbHostReplica = "replica-mydr-sydney-30g.cmkgdpxv1dch.ap-southeast-2.rds.amazonaws.com";
   $dbName = $dbVars['default']['database'];
   $dbLogin = $dbVars['default']['login'];
   $dbPassword = $dbVars['default']['password'];

   $dbHostReplica = "localhost";
   $dbHostReplica = "mydrmysql-5-7-11.cmkgdpxv1dch.ap-southeast-2.rds.amazonaws.com";
   $dbName = 'cake_mydr';
   $dbLogin = 'local';
   $dbLogin = 'mydr_user';
   $dbPassword = 'l0c@l';
   $dbPassword = 'h#G&^V#^&#U849493jtj)##JFJG0';

	/* Defaults to using replica db, if replica is not accessible, then revert to live. */	
	$cakedb = new mysqli($dbHostReplica, $dbLogin, $dbPassword, $dbName);
	if($cakedb->connect_errno){
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
		$sqlStr = "SELECT COUNT(*) AS Total FROM articles WHERE status=1 AND section_id IS NOT NULL ";
		$result = $cakedb->query($sqlStr);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$total = $row['Total'];
		}
		?>
                <html>
                <head>
                        <title>myDr Utility Scripts</title>

			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

			<link href="/scripts/style.css" rel="stylesheet" type="text/css" />
			<script type="text/javascript">
                                //var totalCount = 10;
                                var stopFlag = 0;
                                var totalCount = <?php echo $total; ?>;
                                window.onload = function setDataSource() {
                                        //loadEventSource();
                                        document.getElementById("tickets").style.display = "none";
                                }
                                function loadEventSource(){
                                        document.getElementById("tickets").style.display = "block";
                                        if (!!window.EventSource) {
                                                var source = new EventSource("get_mydr_articles_active.php");
                        
                                                source.addEventListener("message", function(e) {
                                                        updatePrice(e.data);
                                                        logMessage(e);
                                                        if(stopFlag==1){
                                                                source.close(); /* Terminate client */
                                                        }
                                                }, false);
                                                
                                                source.addEventListener("open", function(e) {
                                                        stopFlag=0;
                                                        logMessage("OPENED");
                                                }, false);
                        
                                                source.addEventListener("error", function(e) {
                                                        logMessage("ERROR");
                                                        source.close(); /* Terminate client */
                                                        if (e.readyState == EventSource.CLOSED) {
                                                                logMessage("CLOSED");
                                                        }
                                                }, false);
                                        } else {
                                                document.getElementById("notSupported").style.display = "block";
                                        }
                                }
				function updatePrice(data) {
                                        var ar = data.split(":");
                                        var pData = ar[0];
                                        var ctr = ar[1];
                                        var el = document.getElementById("tUpdate");
                                        var iUrl = document.getElementById("tUrl");
                                        var oldPrice = el.innerHTML;

                                        if(ctr=="finished"){
                                                iUrl.innerHTML = "<br />Result: <a href='"+pData+"'>Click here to download file.</a>";
                                                $('.progress-bar-success').attr('style', 'width: 100%;');
                                                $('.progress-bar-success').html("100% Complete..");
                                        }else{
                                                el.innerHTML = "["+ctr+"] "+pData;
                                                $('.progress-bar-success').attr('style', 'width: '+ctr+'%;');
                                                $('.progress-bar-success').html(ctr+"% Complete..");
                                        }
                        
                                }
                        
                                function logMessage(obj) {
                                        var el = document.getElementById("log");
                                        if (typeof obj === "string") {
                                                el.innerHTML += obj + "<br>";
                                        } else {
                                                el.innerHTML += obj.lastEventId + " - " + obj.data + "<br>";
                                        }
                                        el.scrollTop += 20;
                                }
                        
                        </script>
		<body>
			<h1>myDr Articles list</h1>
			<form action='get_mydr_articles.php' method='post'>
				<input type='hidden' name='op' value='yes' />
				<p>
					Total subscribers: <?php echo $total; ?> 
					<input type='button' value='Get CSV file...' onclick='loadEventSource();'>
					<input style="width: 150px; text-align: center;" type='button' value='Cancel' onclick='stopFlag=1;'>
				</p>
			</form>
                        <div class="container" style="margin: 10px;">
                                <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" 
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        </div>
                                </div>
                        </div>
			<div id="tickets">
                                <div class="ticket"><div class="name">Status</div><div class="price" id="tUpdate"></div></div>
                                <div class="ticket"><div class="name"></div><div class="price" id="tUrl"></div></div>
                        </div>
                        <div id="log" style="display: none;"></div>
		</body>
		</html>
		<?php 

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
