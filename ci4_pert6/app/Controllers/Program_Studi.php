<?php namespace App\Controllers;

use App\Models\Program_Studi_Model;

class Program_Studi extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();
        $this->prodi = new Program_Studi_Model($db);
    }
    
    public function index()
	{
        $data['session'] = $this->session->getFlashData('response');
        $data['dataProdi'] = $this->prodi->get()->getResult();

        echo view('header_v');
        echo view('program_studi_v', $data);
        echo view('footer_v');
    }

    public function add()
    {
        echo view('header_v');
        echo view('program_studi_form_v');
        echo view('footer_v');
    }

    public function edit($id)
    {
        $where = ['kode_prodi' => $id];

        $data['dataProdi'] = $this->prodi->get($where)->getResult()[0];

        echo view('header_v');
        echo view('program_studi_form_v', $data);
        echo view('footer_v');
    }

    public function save()
    {
        $data = [
            'kode_prodi' => $this->request->getPost('kode'),
            'nama_prodi' => $this->request->getPost('nama'),
            'ketua_prodi' => $this->request->getPost('ketua'),
        ];

        $id = $this->request->getPost('id');

        // insert
        if (empty($id)) {
            $response = $this->prodi->insert($data);

            if ($response->resultID) {
                $this->session->setFlashdata('response', [
                    'status' => $response->resultID,
                    'message' => 'Data berhasil disimpan.',
                    ]);
            } else {
                $this->session->setFlashdata('response', [
                    'status' => $response->resultID,
                    'message' => 'Data gagal disimpan. '. $response->connID->error,
                    ]);
            }

        } else {
            // update
            
            $where = ['kode_prodi' => $id];
            $response = $this->prodi->update($data, $where);


            if ($response) {
                $this->session->setFlashdata('response', [
                    'status' => $response,
                    'message' => 'Data berhasil disimpan.',
                    ]);
            } else {
                $this->session->setFlashdata('response', [
                    'status' => $response,
                    'message' => 'Data gagal disimpan. ',
                    ]);
            }
        }

        return redirect()->to(site_url('Program_Studi'));
    }

    public function delete($id)
    {
        $where = ['kode_prodi' => $id];

        $response = $this->prodi->delete($where);

        if ($response->resultID) {
            $this->session->setFlashdata('response', [
                'status' => $response->resultID,
                'message' => 'Data berhasil dihapus.',
                ]);
        } else {
            $this->session->setFlashdata('response', [
                'status' => $response->resultID,
                'message' => 'Data gagal dihapus. '. $response->connID->error,
                ]);
        }
        
        return redirect()->to(site_url('Program_Studi'));
    }
}
