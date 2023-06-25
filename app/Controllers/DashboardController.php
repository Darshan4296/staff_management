<?php

namespace App\Controllers;

use App\Models\PresentModel;
use App\Models\UserModel;

/**
 * DashboardController
 */
class DashboardController extends AdminController
{
    /**
     * Dashboard page
     */
    public function index()
    {
        $model = new UserModel();
        // Get counts of staff 
        $staff = $model->where('role', 'staff')->countAllResults();

        $user = session()->get('loggedUser');

        $presentModel = new PresentModel();
        // Get last record of user present
        $present = $presentModel->where('user_id', $user['id'])
            ->orderBy('id', 'desc')
            ->first();

        return view('dashboard/index', [
            'staff' => $staff, // Staff count
            'user' => $user, // Pass user data to show user info in topbar
            'present' => $present // To check for clock_in / clock_out
        ]);
    }
}

?>