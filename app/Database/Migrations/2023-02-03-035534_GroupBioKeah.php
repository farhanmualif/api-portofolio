<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupBioKeah extends Migration
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
            'id_keahlian' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_biodata', 'tb_biodata', 'id_biodata', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_keahlian', 'tb_keahlian', 'id_keahlian', 'CASCADE', 'CASCADE');
        $this->forge->createTable('group_bio_keah');
    }

    public function down()
    {
        $this->forge->dropTable('group_bio_keah');
    }
}
