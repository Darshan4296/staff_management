<?php

namespace App\Controllers;

use App\Models\PresentModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

/**
 * PresentController
 */
class PresentController extends ResourceController
{
    use ResponseTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        helper(['utility']);
    }

    /**
     * Present list page of a user
     */
    public function index()
    {
        $userId = $this->request->getGet('user_id');

        if (empty($userId)) {
            return redirect()->to('/staff')->with('fail', 'Invalid request!');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $presentModel = new PresentModel();
        $presents = $presentModel->where('user_id', $userId)->findAll();

        return view('presents/index', ['presents' => $presents, 'user' => $user]);
    }

    /**
     * API: to save Clock in time
     */
    public function clockIn() {
        $userId = $this->request->getGet('user_id');

        $model = new PresentModel();

        $present = $model->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first();

        /**
         * Logical comment:
         * empty($present): When no record for the user allow to clock in
         * !empty($present['clock_out']): Staff yet not clocked out, so not allow to clock in again        
         */
        if (empty($present) || !empty($present['clock_out'])) {

            try {
                $model->insert([
                    'user_id' => $userId,
                    'clock_in' => date('Y-m-d H:i:s')
                ]);

                $response = [
                    'status'   => 201,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Clock in time saved!'
                    ]
                ];
                return $this->respondCreated($response);
            } catch (\Throwable $th) {
                return $this->failNotFound('Invalid request!');
            }
        }

        return $this->failNotFound('User not clock out yet');
    }

    /**
     * API: to save Clock out time
     */
    public function clockOut() {
        $userId = $this->request->getGet('user_id');

        $model = new PresentModel();

        $present = $model->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first();

        /**
         * Logical comment:
         * empty($present): When no record for the user not allow to clock out
         */
        if (empty($present)) {
            return $this->failNotFound('Invalid request!');
        }

        /**
         * Logical comment:
         * !empty($present['clock_out']): Staff already clocked out
         */
        if (!empty($present['clock_out'])) {
            return $this->failNotFound('User already clocked out');
        }

        try {
            $model->update($present['id'], [
                'user_id' => $userId,
                'clock_out' => date('Y-m-d H:i:s')
            ]);

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Clock out time saved!'
                ]
            ];
            return $this->respondCreated($response);
        } catch (\Throwable $th) {
            return $this->failNotFound('Invalid request!');
        }
    }
}

?>