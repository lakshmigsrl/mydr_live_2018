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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php
    echo $this->Html->css(['bootstrap/bootstrap.css', 'custom.css']);
    echo $this->Html->script(['jquery/jquery.js', 'bootstrap/bootstrap.js']);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            echo $this->Html->image('mydr_logo.png', [
            "alt" => 'Admin',
            'url' => '/admin'
            ]);
            ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(!empty($authUser)):?>
                    <li><a href="/admin/users/logout">Logout</a></li>
                <?php else:?>
                    <li><a href="/admin/">Login</a></li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid main_container">
    <div class="row">
        <?= $this->Flash->render() ?>
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <?php
            echo $this->element('/Admin/sidebar');
            ?>
        </div>
        <div class="col-sm-9 col-md-10 main admin_background">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<footer>
</footer>

<?php
if(!empty($this->request->session()->read('Auth.User'))):
    if($this->templatePath === 'Admin/Articles' && isset($article->id)):
        echo "<div style='position: fixed !important;position: absolute;top: 0; left: 500px; width: 100%;z-index:9999;'><a href='/".$article->section->url."/".$article->url."' target='_blank' class='btn btn-primary'>View</a></div>";
    elseif($this->templatePath ===  'Admin/Tools' && isset($tool->id)):
        echo "<div style='position: fixed !important;position: absolute;top: 0; left: 500px; width: 100%;z-index:9999;'><a href='/tools/".$tool->url."' target='_blank' class='btn btn-primary'>View</a></div>";
    elseif($this->templatePath === 'Admin/CmiProducts' && isset($cmiProduct->id)):
        echo "<div style='position: fixed !important;position: absolute;top: 0; left: 500px; width: 100%;z-index:9999;'><a href='/medicines/cmis/".$cmiProduct->full_url."' target='_blank' class='btn btn-primary'>View</a></div>";
    elseif($this->templatePath === 'Admin/Sections' && isset($section->id)):
        echo "<div style='position: fixed !important;position: absolute;top: 0; left: 500px; width: 100%;z-index:9999;'><a href='/".$section->url."' target='_blank' class='btn btn-primary'>View</a></div>";
    endif;
endif;
?>
</body>
</html>
