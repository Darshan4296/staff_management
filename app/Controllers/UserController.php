<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait; 

/**
 * UserController: for API
 */
class UserController extends BaseController
{
    use ResponseTrait;

    /**
     * Construct
     */
    public function __construct()
    {
        // load helpers
        helper(['url','form', 'api']);
    }
    
    /**
     * Add Staff: Get request from API to create staff
     */
    public function store()
    {    
        $userModel = new UserModel();

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'role' => 'staff',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            // save password encrypted
            $data['password'] = password_hash((string) $password, PASSWORD_DEFAULT);
        }

        $profilephoto = $this->request->getPost('profilephoto');
        if (!empty($profilephoto)) {
            $data['profilephoto'] = $profilephoto;
        }

        try {
            $staff = $userModel->insert($data);
            $this->handleEmail($data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'New staff user created successfully!'
                ],
                'id' => $staff
            ];

            return $this->respondCreated($response);
        } catch (\Throwable $error) {
            return $this->failNotFound('something went wrong');
        }
    }

    /**
     * Update staff: Get request from API to update staff
     */
    public function update($id)
    {
        if (empty($id)) {
            return json_encode([
                'status'   => 500,
                'error'    => true,
                'messages' => [
                    'error' => 'Invalid Request'
                ]
            ]);
        }
        
        $userModel = new UserModel();
        $staff = $userModel->find($id);

        if (empty($staff)) {
            return json_encode([
                'status'   => 500,
                'error'    => true,
                'messages' => [
                    'error' => 'Invalid Request'
                ]
            ]);
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            // save password encrypted
            $data['password'] = password_hash((string) $password, PASSWORD_DEFAULT);
        }
        $profilephoto = $this->request->getPost('profilephoto');
        if (!empty($profilephoto)) {
            $data['profilephoto'] = $profilephoto;
        }

        try {
            $userModel->update($id, $data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Staff record update successfully'
                ],
                'id' => $id
            ];

            return $this->respondCreated($response);
        } catch (\Throwable $error) {
            $response = [
                'status'   => 500,
                'error'    => null,
                'messages' => [
                    'error' => 'Error occur for the staff update'
                ],
            ];

            return $this->respondCreated($response);
        }
    }

    /**
     * Handle function to send welcome email
     */
    private function handleEmail($user) {
        $email = \Config\Services::email();

        // Sender and recipient details
        $from = 'darshan@example.com';
        $to = $user['email'];
        $subject = 'Welcom to team!';
        $message = sprintf('<p>Hello %s %s</p>', $user['firstname'], $user['lastname']);
        $message .= '<p>Your user is created.</p>';
        $message .= '<p>Best Regards, <br/>Team Admin</p>';

        // Set the email details
        $email->setFrom($from);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        // Send the email
        if ($email->send()) {
            return 'Email sent successfully!';
        } else {
            return 'Email sending error.';
        }
    }
}
