<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPortofolio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_portofolio' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_portofolio' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'img_portofolio' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ]
        ]);

        $this->forge->addKey('id_portofolio', true);
        $this->forge->createTable('tb_portofolio');
    }

    public function down()
    {
        $this->forge->dropTable('tb_portofolio');
    }
}
