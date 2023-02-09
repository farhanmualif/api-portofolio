<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PortofolioModel;
use finfo;

class PortofolioApi extends ResourceController
{
    function __construct()
    {
        $this->model = new PortofolioModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->model->findAll();
        if (!$data) {
            $respons = [
                'status' => false,
                'code' => 404,
                'message' => 'data tidak diteemukan',
                'data' => $data
            ];
            return $this->respond($respons);
        }
        $respons = [
            'status' => true,
            'code' => 200,
            'message' => 'berhasil mendapatkan data',
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
        $data = $this->model->where('id_portofolio', $id)->first();

        $respons = [
            'status' => 'data ditemukan',
            'data' => $data
        ];

        if (!$data) {
            $fail = [
                'status' => false,
                'message' => 'data tidak ditemukan'
            ];
            return $this->respond($fail);
        }

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
        $rules = $this->validate([
            'nama_portofolio' => [
                'rules' => 'required',
                'errors' => '{field} tidak boleh kosong'
            ]
        ]);
        if (!$rules) {
            $respons = $this->validator->getErrors();
            return $this->failValidationErrors($respons);
        }
        $file_img = $this->request->getFile('img_portofolio');
        if ($file_img->getError() == 4) {
            $img = 'default.png';
        } else {
            $img = $file_img->getRandomName();
            $file_img->move('portofolio', $img);
        }


        $data = [
            'nama_portofolio' => $this->request->getVar('nama_portofolio'),
            'img_portofolio' => $img
        ];
        if ($this->model->insert($data)) {
            $respons = [
                'status' => true,
                'message' => 'berhasil menambah data'
            ];
            return $this->respondCreated($respons);
        } else {
            $respons = [
                'status' => false,
                'message' => 'gagal menambahkn data'
            ];
            return $this->respond($respons);
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
        $validate = $this->validate([
            'nama_portofolio' => [
                'rules' => 'required',
                'errors' => '{field} tidak boleh kosong'
            ]
        ]);
        if (!$validate) {
            $respons = [
                'status' => false,
                'message' => $this->validator->getErrors()
            ];
            return $this->respond($respons);
        }
        $find = $this->model->where('id_portofolio', $id)->first();
        if (!$find) {
            $response = [
                'status' => false,
                'massage' => 'data tidak ada'
            ];
            return $this->respond($response);
        }
        $data = [
            'nama_portofolio' => $this->request->getVar('nama_portofolio')
        ];
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            $respons = [
                'status' => true,
                'message' => 'update data berhasil'
            ];
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
        $find = $this->model->where('id_portofolio', $id)->first();
        if (!$find) {
            $respons = [
                'status' => false,
                'message' => 'data tidak ada'
            ];
            return $this->respond($respons);
        }
        if ($this->delete($id)) {
            $respons = [
                'status' => true,
                'message' => 'hapus data berhasil'
            ];
            return $this->respond($respons);
        } else {
            $respons = [
                'status' => false,
                'message' => 'gagal menghapus data'
            ];
            return $this->respond($respons);
        }
    }
}
