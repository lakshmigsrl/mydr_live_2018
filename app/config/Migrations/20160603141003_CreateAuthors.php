<?php
use Migrations\AbstractMigration;

class CreateAuthors extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('authors');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('first_name', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('last_name', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('profile', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('main_image', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('social', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('job_title', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => true,
        ]);
        $table->addColumn('url', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => true,
        ]);
        $table->addColumn('facebook_link', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => true,
        ]);
        $table->addColumn('linkedin_link', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => true,
        ]);
        $table->addColumn('twitter_link', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
