<?php namespace App\Database\Migrations;
 
use CodeIgniter\Database\Migration;
 
class Pelajar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelajar'           => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'email'         => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
                'unique'            => true,
            ],
            'nama'         => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'katasandi'         => [
                'type'              => 'VARCHAR',
                'constraint'        => '60',
            ],
            'organisasi'         => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'aktivasi'          => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
            ],
            'token_aktivasi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'            => true,
            ],
            'token_lupa_katasandi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'            => true,
            ],

            
        ]);
        $this->forge->addKey('id_pelajar', TRUE);
        $this->forge->createTable('pelajar');
    }
 
    //--------------------------------------------------------------------
 
    public function down()
    {
        $this->forge->dropTable('pelajar');
    }
}