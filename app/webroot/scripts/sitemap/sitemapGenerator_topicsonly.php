<?php
require_once '/var/www/prod/cakemydr/mydr.com.au/config/database.php';
echo '<link href="/scripts/style.css" rel="stylesheet" type="text/css" />';

	echo "<h1>myDr's Sitemap Generator - TOPICS only...</h1>";
	echo "<form action='sitemapGenerator_topicsonly.php' method='post'>";
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
				" ";
	$endTags_SiteMap = "</urlset>";
	
	//$dateNow = date("Y-m-d_His");
	//$fname = 'sitemap_'.$dateNow.'.xml';
	$fname = 'sitemap_topics.xml';
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
		
		//fwrite($fh, $xml_newline);
		$ctr++;
		//echo "-->>section:  ".$rowSections['title']." -  ".$url_section;
		
		/* Get myDr topic/teaser pages. */	
		/* Will need to remove this later... */
		$sqlTeasers = "SELECT id, title, url  FROM teasers WHERE section_id = ".$rowSections['id']." ";
		$resultTeasers = mysql_query($sqlTeasers);
		while($rowTeaser = mysql_fetch_array($resultTeasers, MYSQL_ASSOC))
		{
			$teaserURL = "http://www.mydr.com.au/topics/".$rowTeaser['url'];
			$xml_newline = "<url><loc>".$teaserURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$teaserURL."\n";
		}
		
		/* Get myDr article pages. */	
		/*
		$sqlArticles = "SELECT id, title, url  FROM articles WHERE section_id = ".$rowSections['id']." AND pub_status = 1 ORDER BY url";
		$resultArticles = mysql_query($sqlArticles);
		while($rowArticles = mysql_fetch_array($resultArticles, MYSQL_ASSOC))
		{
			//$articleURL = $url_section."/".$rowArticles['url'];
			$articleURL = "http://www.mydr.com.au/articles/".$rowArticles['url'];
			$xml_newline = "<url><loc>".$articleURL."</loc></url>";
			fwrite($fh, $xml_newline);
			$ctr++;
			//echo $ctr."\t\t\t:  ".$articleURL."\n";
		}
		*/
	}	
	
	/* Get cmis pages. */
	/* Get support group pages. */
	/* Get tools pages. */
	/* Get practice websites pages. */
		
	
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

