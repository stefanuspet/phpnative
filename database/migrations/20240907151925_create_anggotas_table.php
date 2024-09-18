<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAnggotasTable extends AbstractMigration
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
        $table = $this->table('anggotas', ['id' => false, 'primary_key' => ['nid']]);
        $table
            ->addColumn('nid', 'biginteger', ['signed' => false, 'identity' => true,]) // Manual input
            ->addColumn('id_dojo', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('nama', 'string', ['null' => false])
            ->addColumn('jenis_kelamin', 'string', ['null' => false])
            ->addColumn('alamat', 'string', ['null' => false])
            ->addColumn('tahun_gabung', "integer", ['null' => false])
            ->addColumn('status', 'string', ['null' => false])
            ->addColumn('tingkat_sabuk', 'string', ['null' => false])
            ->addColumn('nomor', 'integer', ['null' => false])
            ->addColumn('foto', 'string', ['null' => false])
            ->addColumn('tanggal_lahir', 'date', ['null' => false])
            ->addColumn('tempat_lahir', 'string', ['null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey("id_dojo", "dojos", "id", ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addIndex(['nid'], ['unique' => true])
            ->create();
    }
}
