<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama_user' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'password_user' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
