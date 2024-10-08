<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePrestasisTable extends AbstractMigration
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
        $table = $this->table('prestasis', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'biginteger', ['signed' => false, 'identity' => true])
            ->addColumn('id_anggota', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('nama', 'string', ['null' => false])
            ->addColumn('tingkat', 'string', ['null' => false])
            ->addColumn('peringkat', 'string', ['null' => false])
            ->addColumn('waktu_dapat', 'date', ['null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey("id_anggota", "anggotas", "nid", ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
