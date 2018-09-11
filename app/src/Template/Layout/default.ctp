<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'mydr.com.au: reliable medical consumer information.';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="google-site-verification" content="wbi3EMNCS-gJdk-jL5kBPzJZGld9JqfOgJHc3P2ww0Q" />
    <?= $this->Html->charset() ?>
    <title>
        <?php  /* $cakeDescription*/  ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.png', '/favicon.png', ['type' => 'icon']); ?>

    <?= $this->fetch('meta') ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <style type="text/css">body{display: none;}</style>
    <?= $this->fetch('css') ?>

    <?php
    if($this->templatePath === 'Tools'):
        $js = [
            '//code.jquery.com/jquery-1.12.4.min.js',
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
            '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',
        ];
        echo $this->Html->script($js);
    else:
        echo $this->AssetCompress->script('libs', ['async']);
    endif;?>
    <?= $this->fetch('script') ?>
 
    <!-- Facebook Pixel Code -->
    <script>
       !function(f,b,e,v,n,t,s)
       {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
       n.callMethod.apply(n,arguments):n.queue.push(arguments)};
       if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
       n.queue=[];t=b.createElement(e);t.async=!0;
       t.src=v;s=b.getElementsByTagName(e)[0];
       s.parentNode.insertBefore(t,s)}(window, document,'script',
       'https://connect.facebook.net/en_US/fbevents.js');
       fbq('init', '1642595269338156');
       fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
     src="https://www.facebook.com/tr?id=1642595269338156&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

    <!--DFP Publisher Tag-->
    <!-- 
    <script async src="https://www.googletagservices.com/tag/js/gpt.js"></script>
    <script type='text/javascript'>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
        (function() {
            var gads = document.createElement('script');
            gads.async = true;
            gads.type = 'text/javascript';
            var useSSL = 'https:' == document.location.protocol;
            gads.src = (useSSL ? 'https:' : 'http:') +
              '//www.googletagservices.com/tag/js/gpt.js';
            var node = document.getElementsByTagName('script')[0];
            node.parentNode.insertBefore(gads, node);
        })();
    </script>
    <!-- START DFP Publisher Tags Ad positions -->
		
<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
// Define the responsive ad sizes
 var gptAdSlots = [];
  googletag.cmd.push(function() {

	var leaderboardsizes		= 	googletag.sizeMapping().addSize([728, 300], [728, 90]).addSize([640, 300], [468, 60]).addSize([0, 0], [320, 50]).build();
	var squaresizes				= 	googletag.sizeMapping().addSize([980, 690], [300, 600]).addSize([0, 0], [300, 250]).build();
	//var footersizes				= 	googletag.sizeMapping().addSize([640, 480], [468, 60]).addSize([0, 0], [320, 50]).build();
	var outstreamsizes			= googletag.sizeMapping().addSize([640, 480], [1.0, 1.0]).addSize([0, 0], [1.0, 1.0]).build();

     // Now we define all of the ad slots giving them their corresponding name of leaderboard square or footer with corresponding size mappings
     gptAdSlots[0] = googletag.defineSlot('/1620232/MyDr-Responsive', [[728, 90], [468, 60], [320, 50]], 'leaderboard_ad').defineSizeMapping(leaderboardsizes).addService(googletag.pubads());
     gptAdSlots[1] = googletag.defineSlot('/1620232/MyDr-Responsive', [[300, 600], [300, 250]], 'square_ad').defineSizeMapping(squaresizes).addService(googletag.pubads());
	 gptAdSlots[2] = googletag.defineSlot('/1620232/MyDr-Responsive', [1.0, 1.0], 'outstream').defineSizeMapping(outstreamsizes).addService(googletag.pubads());  
	 //gptAdSlots[3] = googletag.defineSlot('/1620232/MyDr-Responsive', [[468, 60], [320, 50]], 'footer').defineSizeMapping(footersizes).addService(googletag.pubads());

    googletag.pubads().setTargeting("environment", "prod1")
      .setTargeting("title", "<?= $this->fetch('title') ?>" )
      <?php if(isset($cmiProduct->full_url)):?>
      .setTargeting("pageurl", "<?= $cmiProduct->full_url; ?>" )
	   <?php endif;?>
    <?php if(isset($dfp_values['article_id'])):?>
	  .setTargeting("articleID", "<?= $dfp_values['article_id'];?>")
	  <?php endif;?>
	  <?php if(isset($dfp_values['section'])):?>
	  .setTargeting("section", "<?= $dfp_values['section'];?>")
	  <?php endif;?>
	  <?php if(isset($dfp_values['content_type'])):?>
	  .setTargeting("content_type", "<?= $dfp_values['content_type'];?>")
	  <?php endif;?>
    googletag.pubads().collapseEmptyDivs(true);
      
    googletag.pubads().enableSingleRequest();
    googletag.companionAds().setRefreshUnfilledSlots(true); 
    googletag.pubads().enableVideoAds();    
    googletag.enableServices();
  });
</script>	


    </script>
    <!-- END DFP Publisher Tags Ad positions -->
    
    
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet" />
    <style>
      body {
          font-family: 'Libre Franklin', "Helvetica Neue", Helvetica, Arial, sans-serif !important;
      }
    </style>
</head>
<body>


    <?php /*HEADER START*/ ?>
        <?= $this->element('navigation') ?>
        <?php if(isset($article)):?>
            <?= $this->element('breadcrumbs', ['section' => $article->section, 'article' => $article]) ?>
        <?php elseif(isset($author)):?>
            <?= $this->element('breadcrumbs', ['section' => false, 'author' => $author]) ?>
        <?php elseif(isset($tool)):?>
            <?= $this->element('breadcrumbs', ['section' => false, 'tool' => $tool]) ?>
        <?php elseif(isset($breadcrumb)):?>
            <?= $this->element('breadcrumbs_simple', ['breadcrumb' => $breadcrumb]) ?>
        <?php endif;?>
    <?php /*HEADER END*/ ?>


    <?= $this->Flash->render() ?>
    <!-- <div class="container clearfix"> -->
        <?= $this->fetch('content') ?>
    <!-- </div> -->


    <?php /*FOOTER START*/ ?>
        <?= $this->element('footer') ?>
    <?php /*FOOTER END*/ ?>

    <noscript id="deferred-styles">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <?= $this->AssetCompress->css('all_v2'); ?>
    </noscript>
    <script>
        var loadDeferredStyles = function() {
            var addStylesNode = document.getElementById("deferred-styles");
            var replacement = document.createElement("div");
            replacement.innerHTML = addStylesNode.textContent;
            document.body.appendChild(replacement)
            addStylesNode.parentElement.removeChild(addStylesNode);
        };
        var raf = requestAnimationFrame || mozRequestAnimationFrame ||
          webkitRequestAnimationFrame || msRequestAnimationFrame;
        if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
        else window.addEventListener('load', loadDeferredStyles);
    </script>
    <?= $this->fetch('scriptBottom') ?>
    <script type="text/javascript" async  src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5811810c9e437363"></script>
    <script type="text/javascript">
        var _sj = _sj || [];
        _sj.push(['company', 'drmeptyltd']);
        _sj.push(['collection', 'mydr']);
        _sj.push(['urlquery']);
        (function () {
            var sj = document.createElement('script');
            sj.type = 'text/javascript';
            sj.async = true;
            sj.src = 'https://www.sajari.com/js/sj.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(sj, s);
        })();
    </script>
    <!-- starting google analytics code //-->
    <script type="text/javascript">
        google_analytics_domain_name=".mydr.com.au";
        var _gaq = _gaq || [];

        /* myDr Main GA account */
        _gaq.push(['_setAccount', 'UA-2802005-1'], ['_setDomainName', '.mydr.com.au'], ['_trackPageview']);


        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <!-- ending google analytics code //-->

    <?php
    if(!empty($this->request->session()->read('Auth.User'))):
        if($this->templatePath === 'Articles' && isset($article->id)):
            echo "<div style='position: fixed !important;position: absolute;top: 0; left: 0; width: 100%;'><a href='/admin/articles/edit/".$article->id."' target='_blank'>Edit</a></div>";
        elseif($this->templatePath === 'Tools' && isset($tool->id)):
            echo "<div style='position: fixed !important;position: absolute;top: 0; left: 0; width: 100%;'><a href='/admin/tools/edit/".$tool->id."' target='_blank'>Edit</a></div>";
        elseif($this->templatePath === 'CmiProducts' && isset($cmiProduct->id)):
            echo "<div style='position: fixed !important;position: absolute;top: 0; left: 0; width: 100%;'><a href='/admin/cmi-products/edit/".$cmiProduct->id."' target='_blank'>Edit</a></div>";
        elseif($this->templatePath === 'Sections' && isset($section->id)):
            echo "<div style='position: fixed !important;position: absolute;top: 0; left: 0; width: 100%;'><a href='/admin/sections/edit/".$section->id."' target='_blank'>Edit</a></div>";
        endif;
    endif;
    ?>
</body>
</html>
