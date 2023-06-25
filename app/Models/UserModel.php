<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primarykey = 'id';

    protected $allowedFields = [
        'firstname',
        'lastname',
        'email',
        'password',
        'profilephoto',
        'role',
        'created_at',
        'updated_at'
    ];
}

?>