<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BiodataApi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_biodata' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telf' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'profile' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_biodata', true);
        $this->forge->createTable('tb_biodata');
    }

    public function down()
    {
        $this->forge->dropTable('tb_biodata');
    }
}
