<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ]
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('tbl_kategori');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kategori');
    }
}
