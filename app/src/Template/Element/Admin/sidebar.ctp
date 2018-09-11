<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          General Content
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <ul class="side-nav">
          <li><?= $this->Html->link(__('Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Asset Manager'), '/ckfinder/ckfinder.html', ['target' => '_blank']) ?></li>
          <li><?= $this->Html->link(__('Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('CMI'), ['controller' => 'CmiProducts', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Homepage'), ['controller' => 'Homepages', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Tools'), ['controller' => 'Tools', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Survey'), ['controller' => 'CmiProductSurveys', 'action' => 'index']) ?></li>
          <li>Subscriptions</li>
        </ul>
      </div>
    </div>
  </div>
  <?php if($authUser['role_id'] == 1):?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading4">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
        References
        </a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
      <div class="panel-body">
        <ul class="side-nav">
          <li><?= $this->Html->link(__('Authors'), ['controller' => 'Authors', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Contributors'), ['controller' => 'Contributors', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Sources'), ['controller' => 'Sources', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Footers'), ['controller' => 'Footers', 'action' => 'index']) ?></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading5">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
          Administration
        </a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
      <div class="panel-body">
        <ul class="side-nav">
          <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
          <li><?= $this->Html->link(__('Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        </ul>
      </div>
    </div>
  </div>

<?php endif;?>
</div>
