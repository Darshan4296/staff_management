<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * AdminController
 */
class AdminController extends BaseController
{
    /**
     * Constructor: Checks user login
     */
    public function __construct()
    {
        if(empty(session()->get('loggedUser')))
        {
            header(sprintf('location: %s', site_url('login')));
            exit;
        }
        
        $userModel = new UserModel();
        $userSession = session()->get('loggedUser');

        if ($userSession['id']) {
            $user = $userModel->find($userSession['id']);

            if (empty($user)) {
                header(sprintf('location: %s', site_url('logout')));
            }
            session()->set('loggedUser', $user);
        }
    }
}

?>