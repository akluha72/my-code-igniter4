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
        $model = new WarehouseModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
        ];
        $model->save($data);
        return redirect()->to('/');
    }
}
