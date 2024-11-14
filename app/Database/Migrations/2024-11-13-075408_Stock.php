<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stock extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stok' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'jumlah_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'tgl_update' => [
                'type' => 'DATE',
                'null' => false
            ]
        ]);
        $this->forge->addKey('id_stok', true);
        $this->forge->addForeignKey('id_produk', 'tbl_produk', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_stok');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_stok');
    }
}
