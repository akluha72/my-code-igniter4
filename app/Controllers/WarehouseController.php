<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\WarehouseModel;

class WarehouseController extends BaseController
{
    public function index()
    {
        $model = new WarehouseModel();
        $data['warehouses'] = $model->findAll();
        return view('warehouses/index', $data);
    }

    public function create()
    {
        return view('warehouses/create');
    }
    
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'location' => 'required|min_length[3]',
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new WarehouseModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
        ];
        $model->save($data);
        return redirect()->to('/')->with('success', 'Warehouse added successfully');
    }
}
