<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePembayaransTable extends AbstractMigration
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
        $table = $this->table('pembayarans', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'biginteger', ['signed' => false, 'identity' => true])
            ->addColumn('id_anggota', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('bulan', 'string', ['null' => false])
            ->addColumn('bukti_pembayaran', 'string', ['null' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey("id_anggota", "anggotas", "nid", ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
