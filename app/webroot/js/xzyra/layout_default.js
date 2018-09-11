var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	
	jQ('#loginErrDiv').click(function(){
		//alert('hahahahaha!');
		jQ(this).slideUp('slow');
	});
	
	jQ('#ClickableReferenceDiv > h2').click(function(){
		if(jQ('img', this).attr('src') == '/img/icon_minus_smd.gif'){
			jQ('img', this).attr('src', '/img/icon_plus_smd.gif');
			jQ(this).next('div').hide();			// same as jQ('#ClickableReferenceDiv > div').hide();
			
		}
		else{
			jQ('img', this).attr('src', '/img/icon_minus_smd.gif');
			jQ(this).next('div').show();			//same as jQ('#ClickableReferenceDiv > div').show();
			
		}
	});

});

// Routines for the new rounded corners...
function initCorners() {
    var settings1 = {
      tl: { radius: 4 },
      tr: { radius: 4 },
      antiAlias: true
    }
    var settings2 = {
      tl: { radius: 3 },
      tr: { radius: 3 },
      antiAlias: true 
    }
    curvyCorners(settings1, "h1.rounded");
    curvyCorners(settings1, "h2.rounded");
    curvyCorners(settings1, "h3.rounded");
    curvyCorners(settings2, "h1.minirounded");
    curvyCorners(settings2, "h2.minirounded");
    curvyCorners(settings2, "h3.minirounded");
}

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();
//alert(BrowserDetect.browser);

