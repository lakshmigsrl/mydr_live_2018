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
    <?= $this->Html->charset() ?>
    <title>
        <?php  /* $cakeDescription*/  ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']); ?>

    <?= $this->fetch('meta') ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootify/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootify/css/bootstrap-social.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/bootify/css/styles.css?refr=002">
    <link rel="stylesheet" href="/css/bootify/css/override.css?refr=002">

    <?php /* Styles used for legacy tables. */ ?>
    <link rel="stylesheet" href="/css/redesign2011/netstarter/TableStyleSimple.css?refr=002">
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>


    <!--DFP Publisher Tag-->
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
    <script type='text/javascript'>
        googletag.cmd.push(function() {
            googletag.defineSlot('/1620232/myDr', [[300, 600], [320, 50], [300, 400], [728, 90], [300,250]], 'div-gpt-ad-15198835936430')
            .addService(googletag.pubads())
            <?php if(isset($dfp_values['article_id'])):?>
              .setTargeting("articleID", "<?= $dfp_values['article_id'];?>")
            <?php endif;?>
            <?php if(isset($dfp_values['section'])):?>
              .setTargeting("section", "<?= $dfp_values['section'];?>")
            <?php endif;?>
            <?php if(isset($dfp_values['content_type'])):?>
              .setTargeting("content_type", "<?= $dfp_values['content_type'];?>")
            <?php endif;?>
            .setTargeting("pos", "right_top");
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.pubads().enableVideoAds();
            googletag.enableServices();
        });
    </script>
    <!-- END DFP Publisher Tags Ad positions -->
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


    <!-- jQuery Version 1.12.4 -->
    <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="/css/bootify/js/jscode.js"></script>
    <?= $this->fetch('scriptBottom') ?>

    <!-- Go to www.addthis.com/dashboard to customize your tools
        Sharing Buttons
    -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5811810c9e437363"></script>


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
</body>
</html>
