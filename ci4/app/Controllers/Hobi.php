<?php namespace App\Controllers;

use App\Models\Hobi_Model;
use App\Models\HobiMahasiswa_Model;

class Hobi extends BaseController
{
    protected $hobi_model;
    protected $hobimahasiswa_model;

    public function __construct()
    {
        $this->hobi_model = new Hobi_Model();
        $this->hobimahasiswa_model = new HobiMahasiswa_Model();
    }

	public function index()
	{
        $data = [
            'title' => 'Data Hobi',
            'page' => 'Hobi',
            'dataHobi' => $this->hobi_model->findAll()
        ];

        return view('hobi_v', $data);
    }

    public function add()
    {
        session();

        $data = [
            'title' => 'Tambah Hobi',
            'page' => 'Hobi',
            'validation' => \Config\Services::validation()
        ];

        return view('hobi_form_v', $data);
    }

    public function edit($kode_hobi)
    {
        session();

        if (empty($this->hobi_model->where(['kode_hobi' => $kode_hobi])->first())) {
            return redirect()->to(site_url('Hobi'));
        }

        $data = [
            'title' => 'Ubah Hobi',
            'page' => 'Hobi',
            'validation' => \Config\Services::validation(),
            'hobi' => $this->hobi_model->where(['kode_hobi' => $kode_hobi])->first()
        ];

        return view('hobi_form_v', $data);
    }

    public function save()
    {
        if (!empty($this->request->getVar('kode_hobi'))) {
            $action = 'edit';
            $validate = [
                'kode_hobi' => 'required',
                'hobi' => [
                    'rules' => 'required|is_unique[hobi.hobi]',
                    'errors' => [
                        'required' => 'Kolom hobi tidak boleh kosong.',
                        'is_unique' => 'Hobi sudah terdaftar. Tidak boleh duplikat.'
                    ]
                ]
                    ];
        } else {
            $action = 'add';
            $validate = [
                'hobi' => [
                    'rules' => 'required|is_unique[hobi.hobi]',
                    'errors' => [
                        'required' => 'Kolom hobi tidak boleh kosong.',
                        'is_unique' => 'Hobi sudah terdaftar. Tidak boleh duplikat.'
                    ]
                ]
            ];
        }

        if (!$this->validate($validate)) {
            $validation = \Config\Services::validation();
            if ($action == 'edit') {
                return redirect()->to(site_url('Hobi/edit/'.$this->request->getVar('kode_hobi')))->withInput()->with('validation', $validation);
            } else {
                return redirect()->to(site_url('Hobi/add'))->withInput()->with('validation', $validation);
            }
        }

        if ($action == 'edit') {
            $this->hobi_model->save([
                'kode_hobi' => $this->request->getVar('kode_hobi'),
                'hobi' => $this->request->getVar('hobi')
            ]);
            session()->setFlashdata('tipe', 'success');
            session()->setFlashdata('pesan', 'Hobi berhasil diubah');
        } else {
            $this->hobi_model->save([
                'hobi' => $this->request->getVar('hobi')
            ]);

            session()->setFlashdata('tipe', 'success');
            session()->setFlashdata('pesan', 'Hobi berhasil ditambahkan');
        }


        return redirect()->to(site_url('Hobi'));
    }

    public function delete($kode_hobi)
    {
        $hobiMahasiswa = $this->hobimahasiswa_model->select('kode_hobi')->where('kode_hobi', $kode_hobi)->findAll();
        
        if (empty($hobiMahasiswa)) {
            $this->hobi_model->delete($kode_hobi);
            session()->setFlashdata('tipe', 'success');
            session()->setFlashdata('pesan', 'Hobi berhasil dihapus');
        } else {
            session()->setFlashdata('tipe', 'danger');
            session()->setFlashdata('pesan', 'Hobi gagal dihapus. Hobi sedang dimiliki oleh mahasiswa.');
        }

        return redirect()->to(site_url('Hobi'));
        
    }

}
