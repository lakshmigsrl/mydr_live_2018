function toggle_mydr_analytics(){	
	// starting google analytics code
		google_analytics_domain_name=".mydr.com.au";
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2802005-1']);
		_gaq.push(['_setDomainName', '.mydr.com.au']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	//ending google analytics code
	
	//SiteCatalyst code version: H.14.
	//Copyright 1997-2008 Omniture, Inc. More info available at
	//http://www.omniture.com
		jQ.getScript("/s_code.js", function(){
			//alert("s_code loaded and executed.");
			
			/* You may give each page an identifying name, server, and channel on
			the next lines. */
			//s.pagename=omnitureTitle;
			//s.server=omnitureServer;
			//s.channel=pageChannel;
			//s.pageType=omniturePageType;
			//s.prop1=""
			//s.prop2=""
			//s.prop16=""
			/* Conversion Variables */
			//s.campaign=""
			//s.eVar6=s.prop16;
			//s.eVar13=""
			//s.heir1=omnitureHeir1;
			/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
			var s_code=s.t();if(s_code)document.write(s_code)//-->
			
		});
		
		//if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
	//End SiteCatalyst code version: H.19.4.
	
	//START Nielsen Online SiteCensus V6.0 --><!-- COPYRIGHT 2009 Nielsen Online -->
			jQ.getScript("//secure-au.imrworldwide.com/v60.js", function(){
				//alert("nielsen loaded and executed.");
				
				// here you can use anything you defined in the loaded script
				var pvar = { cid: "auditbc-au", content: "0", server: "secure-au" };
				var trac = nol_t(pvar);
				trac.record().post();
			});			
	//END Nielsen Online SiteCensus V6.0 -->
	
	//Re run javascript ads on mrec.
		//jQ("div#inMrecAd").html("<script type='text/javascript'> alert('no one...'); </script>");
		//jQ("div#inMrecAd").html(jQ("div#cloneMrec").html());
		//getMREC_ad('adf', 'asdf');
}