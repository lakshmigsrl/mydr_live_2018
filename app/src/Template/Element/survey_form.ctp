
<div class="modal fade" tabindex="-1" role="dialog" id="survey-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title">
          <img src="/img/mydr_logo.png" alt="myDr.com.au - trusted Australian health and medicines information" style="width:50px;">
          myDr Survey
        </h4>
        <h5 style="font-weight: bold;">Please answer our quick survey before continuing on to the medicines information</h5>
      </div>
      <div class="modal-body">
        <?= $this->Form->create("",['id' => 'survey-form']) ?>
        <fieldset>
          <?php
          echo $this->Form->hidden('cmi_product_id', ['value' => $cmiProduct->id]);
          echo $this->Form->hidden('cmi_full_url', ['value' => $cmiProduct->full_url]);
          echo $this->Form->hidden('data2', ['value' => $_SERVER['REMOTE_ADDR']]);
          //echo $this->Form->label('answer1', 'Can you please tell us why you are visiting this page?');
          echo $this->Form->label('answer1', 'Would you consider having an online video consultation with a GP,  instead of a face-to-face consultation?');
          echo $this->Form->radio('answer1'
            ,
            [
              //['value' => 'prescribed', 'text' => 'Doctor has prescribed this drug for me or someone else'],
              //['value' => 'heard', 'text' => 'I’ve heard about this drug and want to discuss with my GP about a prescription'],
              //['value' => 'other', 'text' => 'Other: please describe']
              ['value' => 'yes', 'text' => 'Yes'],
              ['value' => 'no', 'text' => 'No']

            ]
            , ['required' => true, 'class' => 'required']

          );
          ?>
          <div class="answer1-part">
            <?php
            echo $this->Form->input('data1', ['label' => false,
//              'required' => true
              'class' => 'required'
            ]);
            ?>
          </div>
          <?php
          /*
          echo $this->Form->label('answer3', 'Are you viewing information about this product…');
          echo $this->Form->radio('answer3'
            ,
            [
              ['value' => 'yourself', 'text' => 'For yourself'],
              ['value' => 'family', 'text' => 'For a family member'],
              ['value' => 'friend', 'text' => 'For a friend'],
            ]
            , ['required' => true]
          );
          */
          ?>
          <div class="answer2-part"></div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
