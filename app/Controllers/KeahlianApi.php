<?php

namespace App\Controllers;

use App\Models\KeahlianModel;
use CodeIgniter\RESTful\ResourceController;

class KeahlianApi extends ResourceController
{
    public function __construct()
    {
        $this->model = new KeahlianModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->model->findAll();
        $respons = [
            'status' => 200,
            'data' => $data
        ];
        return $this->respond($respons);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->where('id_keahlian', $id)->first();
        if (!$data) {
            $respons = [
                'status' => 404,
                'message' => 'data tidak ada'
            ];

            return $this->respond($respons);
        }

        $respons = [
            'status' => 200,
            'message' => 'Berhasil mendaptkan data',
            'data' => $data
        ];
        return $this->respond($respons);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'nama_keahlian' => [
                'rules' => 'require',
                'errors' => '{tidak boleh kosong}'
            ]
        ];
        if ($rules) {
            $respons = $this->validator->getErrors();
            return $this->respond($respons);
        }

        $data = [
            'nama_keahlian' => $this->request->getVar('nama_keahlian')
        ];

        if ($this->model->insert($data)) {
            return $this->respondCreated('Sukses menambah data');
        } else {

            return $this->respond('gagal menambahkan data');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = $this->validate([
            'nama_keahlian' =>[
                'rules' => 'required',
                'errors' => '{field} tidak boleh kosong'
            ]]);

        $data = [
            'nama_keahlian' => $this->request->getVar('nama_keahlian')
        ];
        $data = $this->request->getRawInput();
        $respons = [
            'status' => true,
            'message' => 'update data berhasil'
        ];
        if (!$rules){
            $respons = [
                'status' => 404,
                'message' => $this->validator->getErrors()
            ];
        }
        if ($this->model->update($id,$data)){
            return $this->respondUpdated($respons);
        }

    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->model->find('id_keahlian',$id)->first();
        if ($data){
            if ($this->model->delete($data)){
                $this->respondDeleted('delete data berhsil');
            } else {
                $this->respond('gagal menghapus data');
            }
        } else {
            $this->respond('data tidak ditemukan');
        }
    }
}
