<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDojoMajelisTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('dojo_majelis', ['id' => false, 'primary_key' => ['id_dojo', 'id_majelis']]);
        $table
            ->addColumn('id_dojo', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('id_majelis', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('id_dojo', 'dojos', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('id_majelis', 'majelis', 'nit', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
