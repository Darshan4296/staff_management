<?php

namespace App\Models;

use CodeIgniter\Model;

class PresentModel extends Model
{
    protected $table = 'presents';

    protected $primarykey = 'id';

    protected $allowedFields = [
        'user_id',
        'clock_in',
        'clock_out',
        'created_at',
        'updated_at'
    ];
}

?>