<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MyAdmin extends Seeder
{
    public function run()
    {
        $data = [
            'id'        => 1,
            'firstname' => 'Darshan',
            'lastname'  => 'Vaghela',
            'email'     => 'darshan@example.com',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT)
        ];

        try {
            // Queries
            $this->db->query('INSERT INTO users (id, firstname, lastname, email, password) 
                VALUES(:id:, :firstname:, :lastname:, :email:, :password:)', $data);

            // Using Query Builder
            $this->db->table('users')->insert($data);
        } catch (\Throwable $th) {
            
        }
    }
}
