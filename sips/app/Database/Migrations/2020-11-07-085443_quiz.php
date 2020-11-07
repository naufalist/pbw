<?php namespace App\Database\Migrations;
 
use CodeIgniter\Database\Migration;
 
class Quiz extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_quiz'           => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_pelajar'           => [
                'type'              => 'INT',
                'unsigned'          => true
            ],
            'nilai_quiz'         => [
                'type'              => 'INT',
            ],
            'waktu_quiz'         => [
                'type'              => 'TIME',
            ],
            
        ]);
        $this->forge->addKey('id_quiz', TRUE);
				$this->forge->addForeignKey('id_pelajar','pelajar','id_pelajar','CASCADE','CASCADE');
				$this->forge->createTable('quiz');
				
    }
 
    //--------------------------------------------------------------------
 
    public function down()
    {
        $this->forge->dropTable('quiz');
    }
}