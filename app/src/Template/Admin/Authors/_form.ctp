
<?php
echo $this->Form->input('name');
echo $this->Form->input('url');
echo $this->Form->input('job_title');
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('main_image', ['id' => 'main_image']);
echo '<a id="ckfinder-modal-1" class="button-a button-a-background">Browse Server</a>';
echo $this->Form->input('facebook_link');
echo $this->Form->input('linkedin_link');
echo $this->Form->input('twitter_link');
echo $this->Form->input('profile', ['id' => 'profile']);
?>