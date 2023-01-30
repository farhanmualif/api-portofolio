<?php

namespace App\Controllers;

use App\Models\BiodataModel;
use CodeIgniter\RESTful\ResourceController;

class BiodataApi extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new BiodataModel();
        $data = $model->findAll();
        $respons = [
            'status' => 200,
            'message' => 'geting data sucessfully',
            'data' => $data
        ];

        return $this->respond($respons, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new BiodataModel();
        $data = $model->where('id', $id)->first();
        $respons = [
            'status' => 200,
            'message' => 'get data success',
            'data' => $data
        ];
        if (!$data) {
            return $this->failNotFound('data tidak ada');
        };
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
        $model = new BiodataModel();
        $rules = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'email' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'no_telf' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'profile' => [
                'rules' =>  'is_image[profile]|mime_in[profile,image/jpg,image/jpeg,image/png,image/JPG,image/JPEG,image/PNG]',
                'errors' => [
                    'is_image' => '{field} bukan gambar',
                    'mime_in' => '{field} bukan gambar'
                ]

            ]

        ]);

        // ambil file
        $file = $this->request->getFile('profile');
        // jika user tidak upload gfambar
        if ($file->getError() == 4) {
            // atur gambar default
            $profile = 'default.png';
        } else {
            // jika user upload gambar lakukan random name file
            $profile = $file->getRandomName();
            // simpan file ke folder profile
            $file->move('profile', $profile);
        }


        if (!$rules) {
            $respons = [
                'message' => $this->validator->getErrors(),
            ];
            return $this->failValidationErrors($respons);
        }
        $respons = [
            'status' => true,
            'message' => 'tambah data berhasil'
        ];
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'no_telf' => $this->request->getVar('no_telf'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'profile' => $profile
        ];
        if ($model->insert($data)) {
            return $this->respondCreated($respons);
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
        $model = new BiodataModel();
        $rules = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'email' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'no_telf' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => '{filed} tidak boleh kosong',
            ],
        ]);
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'no_telf' => $this->request->getVar('no_telf'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'alamat' => $this->request->getVar('alamat')
        ];
        $data = $this->request->getRawInput();
        $respons = [
            'status' => true,
            'message' => 'update data berhasil',
        ];
        if (!$rules) {
            $respons = [
                'code' => 200,
                'status' => false,
                'message' => $this->validator->getErrors()
            ];
        }
        if ($model->update($id, $data)) {
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
        $model = new BiodataModel();
        $data = $model->where('id', $id)->first();;
        if (!$data) {
            $fail = [
                'status' => 404,
                'message' => 'data tidak ada'
            ];
            return $this->respond($fail);
        }
        if ($model->delete($id)) {
            $respons = [
                'status' => 200,
                'message' => 'berhasil hapus data'
            ];
            return $this->respond($respons);
        }
    }
}
