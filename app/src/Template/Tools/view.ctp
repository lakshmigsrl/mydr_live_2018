<?php echo $this->element('Blocks/meta_block', ['type'=>'tools']); ?>
<?php
if($tool->js_code() !== false):
    echo $this->Html->script($tool->js_code(), array('block' => $tool->js_code_bottom()));
endif;
echo $this->Html->css('bootify/css/tools.css', ['plugin' => false]);
?>
<!-- Article Start -->
<div class="container">
    <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

        <div class="col-md-12 col-sm-12">
            <h1><?= h($tool->title) ?></h1>

            <?= $tool->body ?>
            <p><i><span class="item-meta">Last Reviewed: <?= date(DATE_FORMAT, strtotime($tool->reviewed)) ?></span></i></p>

            <?php
            if($tool->reference != 'NULL'):
                echo $this->element('Commons/references', ['references' => $tool->reference]);
            endif;
            ?>

            <div class=" related-content">
                <div class="panel-heading col-xs-12">
                    <h4 class="panel-title">You may also like</h4>
                </div>
                <div data-sj-related data-sj-maxresults="3" ></div>
            </div> <!-- END related-content END-->

        </div><!-- End col-lg-12-->

    </div>

</div>
