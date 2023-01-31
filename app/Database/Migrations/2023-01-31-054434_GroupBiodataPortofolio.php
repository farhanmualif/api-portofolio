<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupBiodataPortofolio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_group_bio_porto' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_portofolio' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsign' => true
            ]
        ]);
        $this->forge->createTable('group_biodata_keahlian');
        $this->forge->addKey('id_group_bio_porto', true);
        $this->forge->addForeignKey('id_portofolio', 'tb_portofolio', 'id_portofolio');
    }

    public function down()
    {
        $this->forge->dropTable('group_biodata_keahlian');
    }
}
