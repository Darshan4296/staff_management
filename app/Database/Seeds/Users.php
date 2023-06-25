<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $admin = [
            'id'        => 1,
            'firstname' => 'Darshan',
            'lastname'  => 'Vaghela',
            'email'     => 'darshan@example.com',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT),
            'role'      => 'admin'
        ];

        try {
            // Using Query Builder
            $this->db->table('users')->insert($admin);
            
        } catch (\Throwable $th) {
            
        }

        $staff = [
            'id'        => 2,
            'firstname' => 'Donald',
            'lastname'  => 'Duck',
            'email'     => 'donald@example.com',
            'password'  => password_hash('staff123', PASSWORD_DEFAULT),
            'role'      => 'staff',
            'profilephoto' => '4591dora.jpg'
        ];
        
        try {
            // Using Query Builder
            $this->db->table('users')->insert($staff);
            
        } catch (\Throwable $th) {
            
        }

    }
}
