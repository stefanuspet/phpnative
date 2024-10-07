<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateKegiatansTable extends AbstractMigration
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
        $table = $this->table('kegiatans', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'biginteger', ['signed' => false, 'identity' => true]) // Set id as BIGINT and auto-increment
            ->addColumn('nama', 'string', ['null' => false])
            ->addColumn('lokasi', 'string', ['null' => false])
            ->addColumn('tanggal', 'date', ['null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('foto', 'string', ['null' => false])
            ->create();
    }
}
