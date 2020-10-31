<?php namespace App\Controllers;

use App\Models\Agama_Model;
use App\Models\Mahasiswa_Model;

class Agama extends BaseController
{
    protected $agama_model;
    protected $mahasiswa_model;

    public function __construct()
    {
        $this->agama_model = new Agama_Model();
        $this->mahasiswa_model = new Mahasiswa_Model();
    }

	public function index()
	{
        $data = [
            'title' => 'Data Agama',
            'page' => 'Agama',
            'dataAgama' => $this->agama_model->findAll()
        ];

        return view('agama_v', $data);
    }

    public function add()
    {
        session();

        $data = [
            'title' => 'Tambah Agama',
            'page' => 'Agama',
            'validation' => \Config\Services::validation()
        ];

        return view('agama_form_v', $data);
    }

    public function edit($kode_agama)
    {
        session();

        if (empty($this->agama_model->where(['kode_agama' => $kode_agama])->first())) {
            return redirect()->to(site_url('Agama'));
        }

        $data = [
            'title' => 'Ubah Agama',
            'page' => 'Agama',
            'validation' => \Config\Services::validation(),
            'agama' => $this->agama_model->where(['kode_agama' => $kode_agama])->first()
        ];

        return view('agama_form_v', $data);
    }

    public function save()
    {
        if (!empty($this->request->getVar('kode_agama'))) {
            $action = 'edit';
            $validate = [
                'kode_agama' => 'required',
                'agama' => [
                    'rules' => 'required|is_unique[agama.agama]',
                    'errors' => [
                        'required' => 'Kolom agama tidak boleh kosong.',
                        'is_unique' => 'Agama sudah terdaftar. Tidak boleh duplikat.'
                    ]
                ]
                    ];
        } else {
            $action = 'add';
            $validate = [
                'agama' => [
                    'rules' => 'required|is_unique[agama.agama]',
                    'errors' => [
                        'required' => 'Kolom agama tidak boleh kosong.',
                        'is_unique' => 'Agama sudah terdaftar. Tidak boleh duplikat.'
                    ]
                ]
            ];
        }

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            if ($action == 'edit') {
                return redirect()->to(site_url('Agama/edit/'.$this->request->getVar('kode_agama')))->withInput()->with('validation', $validation);
            } else {
                return redirect()->to(site_url('Agama/add'))->withInput()->with('validation', $validation);
            }
        }

        if ($action == 'edit') {
            $this->agama_model->save([
                'kode_agama' => $this->request->getVar('kode_agama'),
                'agama' => $this->request->getVar('agama')
            ]);
            session()->setFlashdata('pesan', 'Agama berhasil diubah');
        } else {
            $this->agama_model->save([
                'agama' => $this->request->getVar('agama')
            ]);
            session()->setFlashdata('pesan', 'Agama berhasil ditambahkan');
        }


        return redirect()->to(site_url('Agama'));
    }

    public function delete($kode_agama)
    {
        $agamaMahasiswa = $this->mahasiswa_model->select('kode_agama')->where('kode_agama', $kode_agama)->findAll();
        
        if (empty($agamaMahasiswa)) {
            $this->agama_model->delete($kode_agama);
            session()->setFlashdata('tipe', 'success');
            session()->setFlashdata('pesan', 'Agama berhasil dihapus');
        } else {
            session()->setFlashdata('tipe', 'danger');
            session()->setFlashdata('pesan', 'Agama gagal dihapus. Agama sedang dianut oleh mahasiswa.');
        }
        
        return redirect()->to(site_url('Agama'));
    }

}
