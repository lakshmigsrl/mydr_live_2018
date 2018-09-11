<?php
use Migrations\AbstractMigration;

class CreateFooters extends AbstractMigration
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
        $table = $this->table('footers');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);
        $table->addColumn('value', 'string', [
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
