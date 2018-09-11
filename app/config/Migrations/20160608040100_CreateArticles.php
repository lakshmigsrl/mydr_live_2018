<?php
use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration
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
        $table = $this->table('articles');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('title_header', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('abstract', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('main_image', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('page_image', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('note', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('reference', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('format_type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('medical_type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('audience', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('hi_status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('content_gender', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('section_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('source_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('author_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('footer_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('licensable', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('status', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('legacy_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('start_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('end_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('next_review', 'datetime', [
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
