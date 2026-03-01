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

    public function edit($id)
    {
        $model = new WarehouseModel();
        $warehouse = $model->find($id);
        if (!$warehouse) {
            return redirect()->to('/warehouses')->with('error', 'Warehouse not found.');
        }

        $data['warehouse'] = $warehouse;
        return view('warehouses/edit', $data);
    }

    public function update($id)
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
        $model->update($id, $data);
        return redirect()->to('/warehouses')->with('success', 'Warehouse updated successfully');
    }

    public function delete($id)
    {
        $model = new WarehouseModel();
        $model->delete($id);
        return redirect()->to('/warehouses')->with('success', 'Warehouse deleted successfully');
    }
}
