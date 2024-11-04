<?php

use CodeIgniter\Database\Migration;

class AddPasswordResetToken extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'password_reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'password_reset_token');
    }
}

?>