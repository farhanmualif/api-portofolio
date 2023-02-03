<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKeahlian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keahlian' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_keahlian' => [
                'type' => 'VARCHAR',
                'constraint' => 155
            ]
        ]);
        $this->forge->addKey('id_keahlian', true);
        $this->forge->createTable('tb_keahlian');
    }

    public function down()
    {
        $this->forge->dropTable('tb_keahlian');
    }
}
