<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupBioPorto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_biodata' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'id_portofolio' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_biodata', 'tb_biodata', 'id_biodata', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_portofolio', 'tb_portofolio', 'id_portofolio', 'CASCADE', 'CASCADE');
        $this->forge->createTable('group_bio_porto');
    }

    public function down()
    {
        $this->forge->dropTable('group_bio_porto');
    }
}
