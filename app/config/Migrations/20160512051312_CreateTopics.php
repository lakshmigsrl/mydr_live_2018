<?php
use Migrations\AbstractMigration;

class CreateTopics extends AbstractMigration
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
        $table = $this->table('topics');
        $table->addColumn('section_id', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => false,
        ]);
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => false,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('keywords', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('header', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('details', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('status', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('main_image', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => false,
        ]);
        $table->addColumn('main_image_alttext', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
