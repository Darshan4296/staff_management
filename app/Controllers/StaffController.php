<?php

namespace App\Controllers;

use App\Helpers\Api;
use App\Models\UserModel;

/**
 * StaffController
 */
class StaffController extends AdminController
{

    /**
     * Constructor
     */
    public function __construct()
    {
        helper(['url','form', 'api']);
    }

    /**
     * Staff list page
     */
    public function index()
    {
        $userModel = new userModel();        
        $data['staffs'] = $userModel->where('role', 'staff')->findAll();

        return view('staff/index', $data);
    }

    /**
     * Add staff view page
     */
    public function add()
    {
        return view('staff/add');
    }

    /**
     * Save new staff
     */
    public function store()
    {
        $model = new UserModel();
        $staff = $model->where('email', $this->request->getPost('email'))->countAllResults();
        // if email exist, then return with error 
        if ($staff) {
            return redirect()->back()->with('fail', 'Email is already in use');
        }

        // Validation
        $validation = $this->validate([
            'firstname'=>[
                'rules'=>'required',
                'error'=>[
                    'required'=>'Firstname is Required',
                ]
            ],
            'lastname'=>[
                'rules'=>'required',
                'error'=>[
                    'required'=>'Lastname is Required',
                ]
            ],
            'email'=>[
                'rules'=>'required',
                'error'=>[
                    'required'=>'Email is Required',
                    'valid_email'=>'you must the valid email',
                    'is_unquie'=>'Email is already taken',
                ]
            ],
            'password'=>[
                'rules'=>'required|min_length[5]|max_length[10]',
                'error'=>[
                    'required'=>'Password is Required',
                    'min_length'=>'Password must be atleast 5 character length',
                    'max_length'=>'Password must be atleast 10 character length',
                ]
            ],
            'profilephoto'=>[
                'rules'=>'uploaded[profilephoto]|max_size[profilephoto,2048]|mime_in[profilephoto,image/jpg,image/png]',
                'error'=>[
                    'uploaded'=>'please select Photo',
                    'max_size'=>'the profilephoto maximum size 2MB',
                    'mime_in'=>'only JPEG and PNG image are allow',
                ],
            ]
        ]);

        if(!$validation)
        {
            return view('staff/add',['validation'=>$this->validator]);
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        // Upload image and create unique name
        $profilephoto = $this->request->getFile('profilephoto');
        if (!empty($profilephoto->getName())) {
            $data['profilephoto'] = rand(1000, 9999) . $profilephoto->getName();
            $profilephoto->move(ROOTPATH . '/public/uploads', $data['profilephoto']);
        }

        // API call to save staff
        $response = Api::callApi('user/store', $data);

        $response = json_decode(json_decode($response));

        if ($response->status == 200) {
            return redirect()->to('/staff/'.$response->id.'/edit')->with('success', 'Staff user is created successfully');
        }

        return redirect()->back()->with('fail', 'something went wrong');
    }

    /**
     * Edit view page
     */
    public function edit($id)
    {
        if (empty($id)) {
            return redirect()->to('/staff')->with('fail', 'Invalid Request');
        }
        
        $userModel =  new UserModel();
        $staff = $userModel->find($id);

        if (empty($staff)) {
            return redirect()->to('/staff')->with('fail', 'Invalid Request');
        }

        return view('staff/edit', ['staff' => $staff]);
    }

    /**
     * Update user request
     */
    public function update($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('fail', 'Invalid Request');
        }

        $model = new UserModel();
        // Check if edit user not using other exist email
        $staff = $model->where('email', $this->request->getPost('email'))
            ->where('id !=', $id)
            ->countAllResults();
        
        if ($staff) {
            return redirect()->back()->with('fail', 'Email is already in use');
        }

        $userModel = new UserModel();
        $staff = $userModel->find($id);

        if (empty($staff)) {
            return redirect()->back()->with('fail', 'Invalid Request');
        }

        $profilephoto = $this->request->getFile('profilephoto');

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        // Save image only if submitted
        if (!empty($profilephoto->getName())) {
            $data['profilephoto'] = rand(1000, 9999) . $profilephoto->getName();
            $profilephoto->move(ROOTPATH . '/public/uploads', $data['profilephoto']);
        }

        $password = $this->request->getPost('password');
        // change password only if submitted
        if (!empty($password)) {
            $data['password'] = $password;
        }

        // API call to update staff
        $response = Api::callApi('user/'.$id.'/update', $data);

        $response = json_decode(json_decode($response));

        if ($response->status == 200) {
            return redirect()->to('/staff/'.$response->id.'/edit')->with('success', 'Staff user is created successfully');
        }

        return redirect()->back()->with('fail', 'something went wrong');
    }

}
