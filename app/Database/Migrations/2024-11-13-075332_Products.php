<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'kode_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'foto_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'tgl_register' => [
                'type' => 'DATE',
                'null' => false
            ]
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_kategori', 'tbl_kategori', 'id_kategori', 'SET NULL', 'CASCADE');
        $this->forge->createTable('tbl_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_produk');
    }
}
