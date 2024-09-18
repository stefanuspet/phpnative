<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMajelisTable extends AbstractMigration
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
        $table = $this->table('majelis', ['id' => false, 'primary_key' => ['nit']]);
        $table
            ->addColumn('nit', 'biginteger', ['signed' => false, 'identity' => true]) // Set id as BIGINT and auto-increment
            ->addColumn('nama', 'string', ['null' => false])
            ->addColumn('tahun_gabung', "integer", ['null' => false])
            ->addColumn('jenis_kelamin', 'string', ['null' => false])
            ->addColumn('alamat', 'string', ['null' => false])
            ->addColumn('jabatan', 'string', ['null' => false])
            ->addColumn('tingkat_sabuk', 'string', ['null' => false])
            ->addColumn('spesialis', 'string', ['null' => false])
            ->addColumn('foto', 'string', ['null' => false])
            ->addColumn('tanggal_lahir', 'date', ['null' => false])
            ->addColumn('tempat_lahir', 'string', ['null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['nit'], ['unique' => true])
            ->create();
    }
}
