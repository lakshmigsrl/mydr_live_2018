<?php
use Migrations\AbstractMigration;

class CreateTools extends AbstractMigration
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
        $table = $this->table('tools');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('reference', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('image', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('author_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('publisher_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('js_code', 'string', [
          'default' => null,
          'limit' => 512,
          'null' => false,
        ]);
        $table->addColumn('js_code_bottom', 'boolean', [
          'comment' => 'show js to bottom or content area',
          'default' => 1,
          'limit' => null,
          'null' => true,
        ]);
        $table->addColumn('review', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('reviewed', 'datetime', [
            'default' => null,
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
