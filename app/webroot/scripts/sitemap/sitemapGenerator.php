<?php
require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';
echo '<link href="/scripts/style.css" rel="stylesheet" type="text/css" />';

	echo "<h1>myDr's Sitemap Generator</h1>";
	echo "<form action='sitemapGenerator.php' method='post'>";
	echo "<input type='hidden' name='op' value='yes' />";
	echo "Click here to generate...  <input type='button' value='Generate SiteMap file...' onclick='submit();'> ";
	echo "</form>";
	$op = isset($_POST["op"]) ? $_POST["op"]:"none";
        if($op=="none"){
		die();
        }



   $dbClass = new DATABASE_CONFIG;
   $dbVars = get_class_vars(get_class($dbClass));
   $dbHost = $dbVars['default']['host'];
   $dbName = $dbVars['default']['database'];
   //$dbName_practice = "cake_practice_dev";
   $dbName_practice = "cake_practice";
   $dbLogin = $dbVars['default']['login'];
   $dbPassword = $dbVars['default']['password'];


   $startTags_SiteMap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
				"<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">".
				"<url>".
				"	<loc>http://www.mydr.com.au</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/about</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/disclaimer</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/privacy</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/advertising</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/site-map</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/terms-and-conditions</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/prof-login</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/practice-websites</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/users/forgot-password</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/users/register</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/users/login</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/health-information</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/cmi</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/support-groups</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/medical-dictionary</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/gp</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/optometrist</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/physiotherapist</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/pharmacist</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/podiatrist</loc>".
				"</url><url>".
				"	<loc>http://www.mydr.com.au/search/dietitian</loc>".
				"</url>";
	$endTags_SiteMap = "</urlset>";
	
	//$dateNow = date("Y-m-d_His");
	//$fname = 'sitemap_'.$dateNow.'.xml';
	$fname = 'sitemap_mydr.xml';
	$fpath = '/var/www/prod/cakemydr/mydr.com.au/webroot/content/sitemap/'.$fname;
	$fh = fopen($fpath, 'w+');
	fwrite($fh, $startTags_SiteMap);
				
	error_reporting(E_ALL ^ E_NOTICE);

	$cakedb = mysql_connect($dbHost, $dbLogin, $dbPassword);
	if (!$cakedb) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbName, $cakedb);
	$ctr=25;

	/* Get myDr section pages. */
	$sqlSections = "SELECT id, name, url FROM sections ORDER BY id";
	$result = mysql_query($sqlSections);
	//echo "\n";
	while($rowSections = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		//echo "\n";
		//echo "-->>id: ".$rowSections['id']."\n url: >".$rowSections['url']."<"."\n";
		$url_section = "http://www.mydr.com.au/".$rowSections['url'];
		$xml_newline = "<url><loc>".$url_section."</loc></url>";
		if($rowSections['url']=="health-tools"){
			$xml_newline = "<url><loc>http://www.mydr.com.au/tools</loc></url>";
		}
		if($rowSections['url']=="directories-support"){
			$xml_newline = "<url><loc>http://www.mydr.com.au/directories-and-support</loc></url>";
		}
		
		fwrite($fh, $xml_newline);
		$ctr++;
		//echo "-->>section:  ".$rowSections['title']." -  ".$url_section;
		
		/* Get myDr topic/teaser pages. */	
		/* Will need to remove this later... */
		$sqlTeasers = "SELECT id, title, url  FROM teasers WHERE section_id = ".$rowSections['id']." ";
		$resultTeasers = mysql_query($sqlTeasers);
		while($rowTeaser = mysql_fetch_array($resultTeasers, MYSQL_ASSOC))
		{
			$teaserURL = "http://www.mydr.com.au/topics/".$rowTeaser['url'];
			//$xml_newline = "<url><loc>".$teaserURL."</loc></url>";
			//fwrite($fh, $xml_newline);
			//$ctr++;
			//echo $ctr."\t\t\t:  ".$teaserURL."\n";
		}

		/* Get myDr article pages. */	
		$sqlArticles = "SELECT id, title, url  FROM articles WHERE section_id = ".$rowSections['id']." AND pub_status = 1 ORDER BY url";
		$resultArticles = mysql_query($sqlArticles);
		while($rowArticles = mysql_fetch_array($resultArticles, MYSQL_ASSOC))
		{
			$articleURL = $url_section."/".$rowArticles['url'];
			$xml_newline = "<url><loc>".$articleURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$articleURL."\n";
		}
	}	
	
	/* Get cmis pages. */
	$sqlCMIs = "SELECT ProductID, urlName, url, full_url FROM cmi_products GROUP BY full_url ORDER BY url";
	$result = mysql_query($sqlCMIs);
	//echo "\n";
	while($rowCMIs = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$cmiURL = "http://www.mydr.com.au/medicines/cmis/".$rowCMIs['full_url'];
		$xml_newline = "<url><loc>".$cmiURL."</loc></url>";
		fwrite($fh, $xml_newline);
		$ctr++;
		//echo $ctr."\t\t\t:  ".$cmiURL."\n";

		$sqlMulti = "SELECT * FROM cmi_linkproductdocument WHERE ActualProductID = ".$rowCMIs['ProductID']." GROUP BY DocumentName ";
		$multiRes = mysql_query($sqlMulti);
		$num_rows = mysql_num_rows($multiRes);
		$omitChars = array('-', '/', '%', '\'', '&', '(', ')', '[', ']', ':');
		if($num_rows > 1){ /* Get multi-CMI urls. */
			while($multiCMI = mysql_fetch_array($multiRes, MYSQL_ASSOC)){
				$strMultiLink = trim(strip_tags($multiCMI['Description']));
				$strMultiLink = str_replace($omitChars, '', $strMultiLink);
				$strMultiLink = str_replace(' ', '-', $strMultiLink);
				$strMultiLink = str_replace("amp;", 'and', $strMultiLink);

				$cmiURL = "http://www.mydr.com.au/medicines/cmis/".$rowCMIs['full_url']."/".$strMultiLink;
				$xml_newline = "<url><loc>".$cmiURL."</loc></url>";
				fwrite($fh, $xml_newline);
				$ctr++;
			}
		}
	}

	/* Get support group pages. */
	$sqlSupGrp = "SELECT title, url FROM sgorganisations ORDER BY url";
	$result = mysql_query($sqlSupGrp);
	//echo "\n";
	while($rowSupGrp = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$supportGroupURL = "http://www.mydr.com.au/support-groups/".$rowSupGrp['url'];
		$xml_newline = "<url><loc>".$supportGroupURL."</loc></url>";
		fwrite($fh, $xml_newline);
		$ctr++;
		//echo $ctr."\t\t\t:  ".$supportGroupURL."\n";
	}

	/* Get tools pages. */
	//$xml_newline = "<url><loc>http://www.mydr.com.au/tools</loc></url>";
	//fwrite($fh, $xml_newline);
	//$ctr++;
	$sqlTools = "SELECT title, url FROM tools ORDER BY url AND status = 1 ";
	$result = mysql_query($sqlTools);
	//echo "\n";
	while($rowTool = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$toolURL = "http://www.mydr.com.au/tools/".$rowTool['url'];
		if($rowTool['url']!="travelturtle"){
			$xml_newline = "<url><loc>".$toolURL."</loc></url>";
			fwrite($fh, $xml_newline);
		}
		$ctr++;
		//echo $ctr."\t\t\t:  ".$toolURL."\n";
	}
	
	/* Get practice websites pages. */
	mysql_select_db($dbName_practice, $cakedb);
	$sqlPractice = "SELECT id, name FROM practices WHERE status=1 ";
	$result = mysql_query($sqlPractice);
	//echo "\n";
	while($rowPractices = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$practiceURL = "http://www.mydr.com.au/practice".assemblePracticeURL($rowPractices['name']);
		$xml_newline = "<url><loc>".$practiceURL."</loc></url>";
		fwrite($fh, $xml_newline);
		$ctr++;
		//echo $ctr."\t:  ".$practiceURL."\n";
		
		/* Add sub pages */
		/* This will be gone soon. As we might just render all of these pages in one page via tabbing. */
		$arrSubPages = array('/services', '/findus', '/staff', '/fees', '/policy', '/afterhours', '/news', '/links' );
		foreach($arrSubPages as $subPage){
			$subPracticeURL = $practiceURL.$subPage;
			$xml_newline = "<url><loc>".$subPracticeURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t:  ".$subPracticeURL."\n";
		}

		/* Get practice doctors */
		$sqlDoctors = "SELECT doctors.id, doctors.title, doctors.first_name, doctors.last_name  
						FROM doctors 
							LEFT JOIN doctors_practices ON doctors_practices.doctor_id = doctors.id
							LEFT JOIN practices ON doctors_practices.practice_id = practices.id
						WHERE practices.id = ".$rowPractices['id']." ";
		$resultDoctors = mysql_query($sqlDoctors);
		while($rowDoctors = mysql_fetch_array($resultDoctors, MYSQL_ASSOC))
		{
			//$doctorURL = $practiceURL."/doctors/".$rowDoctors['id'];
			$doctorURL = assembleStaffURL($rowDoctors['title'], $rowDoctors['first_name'], $rowDoctors['last_name']);
			$doctorURL = $practiceURL."/doctors".$doctorURL;

			$xml_newline = "<url><loc>".$doctorURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$doctorURL."\n";
		}

		/* Get practice medics */
		$sqlMedics = "SELECT medics.id, medics.title, medics.first_name, medics.last_name  
						FROM medics
							LEFT JOIN medics_practices ON medics_practices.medic_id = medics.id
							LEFT JOIN practices ON medics_practices.practice_id = practices.id
						WHERE practices.id = ".$rowPractices['id']." ";
		$resultMedics = mysql_query($sqlMedics);
		while($rowMedics = mysql_fetch_array($resultMedics, MYSQL_ASSOC))
		{
			$medicsURL = assembleStaffURL($rowMedics['title'], $rowMedics['first_name'], $rowMedics['last_name']);
			$medicsURL = $practiceURL."/healthteam".$medicsURL;


			$xml_newline = "<url><loc>".$medicsURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$medicsURL."\n";
		}
		/* Get practice staff */ 
		$sqlStaff = "SELECT id, title, first_name, last_name FROM staffs WHERE practice_id=".$rowPractices['id']." ORDER BY id";
		$resultStaff = mysql_query($sqlStaff); 
		while($rowStaff = mysql_fetch_array($resultStaff, MYSQL_ASSOC))
		{
			//$staffURL = $practiceURL."/staff/".$rowMedics['id'];
			$staffURL = assembleStaffURL($rowStaff['title'], $rowStaff['first_name'], $rowStaff['last_name']);
			$staffURL = $practiceURL."/staff".$staffURL;

			$xml_newline = "<url><loc>".$staffURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$staffURL."\n";
		}
	}
	
	
	
	//echo "\n";
	echo "<br />".date("dMy H:i:s")." Successfully generated sitemap at: <a href='http://www.mydr.com.au/content/sitemap/".$fname."'>"
		."http://www.mydr.com.au/content/sitemap/".$fname."</a>";
	fwrite($fh, $endTags_SiteMap);
	fclose($fh);
	mysql_close($cakedb);
	die();
	
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//  F U N C T I O N S . . .
	
function assemblePracticeURL($practiceName){
		$toGetRidOf = array('\"', '"', '.', ',', '(', ')', '*', '&', "\'", "'", "/", "\\");
        $practiceName = str_replace($toGetRidOf, '', strtolower($practiceName));
		$practiceName = preg_replace('!\s+!', ' ', $practiceName);			// Remove multiple spaces and replace them with just one space character...
		
		$url = '/'.str_replace(array(' '), '-', strtolower($practiceName));
        return $url;
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

function assembleStaffURL($Title, $Firstname, $Lastname){
	$toGetRidOf = array('\"', '"', '.', ',', '(', ')', '*', '&', "\'", "'", "/", "\\", "_", " ", "-");
        $URL = '/'.str_replace($toGetRidOf, '', strtolower($Title));
        $URL .= "-".str_replace($toGetRidOf, '', strtolower($Firstname));
        $URL .= "-".str_replace($toGetRidOf, '', strtolower($Lastname));
	return $URL;
}
?>

