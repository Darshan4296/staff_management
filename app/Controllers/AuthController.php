<?php

namespace App\Controllers;

use App\Helpers\Api;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait; 

/**
 * AuthController
 */
class AuthController extends BaseController
{
    use ResponseTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        helper(['api']);
    }

    /**
     * Login action
     */
    public function login()
    {
        if(!empty(session()->get('loggedUser')))
        {
            header(sprintf('location: %s', site_url('/')));
            exit;
        }
        
        return view('auth/login');
    }

    /**
     * Authentication user. Authentication through api call
     */
    public function check()
    {
        $data = [
            'password' => $this->request->getPost('password'),
            'email' => $this->request->getPost('email')
        ];

        // REST API to check user authentication
        $response = Api::callApi('authorize', $data);

        $response = json_decode(json_decode($response));

        if ($response->status == 200) {
            // If login success, then set session for user
            session()->set('loggedUser', (array) $response->user);
            return redirect()->to('/')->with('success', 'Login successfully!');
        }

        return redirect()->back()->with('fail', 'Incorrect login request');
    }

    /**
     * API endpoint: Authorize user for login request
     */
    public function authorize() {
        $password = $this->request->getPost('password');
        
        $email = $this->request->getPost('email');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!empty($user) && password_verify($password, $user['password'])) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'User authorized!'
                ],
                'user' => $user
            ];

            return $this->respondCreated($response);
        }

        return $this->respondCreated([
            'status'   => 500,
            'error'    => true,
            'messages' => [
                'error' => 'Username/Password not matching!'
            ]
        ]);   
    }

    /**
     * Logout
     */
    public function logout() {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to('/login')->with('fail', 'You are logged out!');
        }
        return redirect()->to('/');
    }
}
