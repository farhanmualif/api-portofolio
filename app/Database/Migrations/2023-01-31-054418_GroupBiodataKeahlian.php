<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;;

class GroupBiodataKeahlian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_group_bio_keah' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_biodata' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsign' => true
            ]
        ]);
        $this->forge->createTable('group_biodata_keahlian');
        $this->forge->addKey('id_group_bio_keah', true);
        $this->forge->addForeignKey('id_biodata', 'tb_biodata', 'id_biodata');
    }

    public function down()
    {
        $this->forge->dropTable('group_biodata_keahlian');
    }
}
