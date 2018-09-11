<div class="tools form large-9 medium-8 columns content">
  <?= $this->Form->create($tool) ?>
  <fieldset>
    <legend><?= __('Tool') ?></legend>
    <?php
    echo $this->Form->input('title');
    echo $this->Form->input('url');
    echo $this->Form->input('description');
    echo $this->Form->input('body');
    echo $this->Form->input('reference');
    echo $this->Form->input('js_code',['label' => 'JS code Ex) test.js, test2.js']);
    echo $this->Form->input('js_code_bottom');
    echo $this->Form->input('image', ['label' => 'Image']);
    echo '<a id="ckfinder-modal-1" class="button-a button-a-background">Browse Server</a>';
    echo $this->Form->input('author_id', ['options' => $authors, 'empty' => '-']);
    echo $this->Form->input('publisher_id');
    echo $this->Form->input('status',['options' => $constant_options['status']]);
    echo $this->Form->input('review', ['label' => 'Next review']);
    echo $this->Form->input('reviewed');
    ?>
  </fieldset>
  <?= $this->Form->button(__('Submit')) ?>
  <?= $this->Form->end() ?>
</div>