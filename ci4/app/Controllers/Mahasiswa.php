<?php namespace App\Controllers;

use App\Models\Agama_Model;
use App\Models\Hobi_Model;
use App\Models\HobiMahasiswa_Model;
use App\Models\Mahasiswa_Model;

class Mahasiswa extends BaseController
{
    protected $agama_model;
    protected $hobi_model;
    protected $hobimahasiswa_model;
    protected $mahasiswa_model;

    public function __construct()
    {
        $this->agama_model = new Agama_Model();
        $this->hobi_model = new Hobi_Model();
        $this->hobimahasiswa_model = new HobiMahasiswa_Model();
        $this->mahasiswa_model = new Mahasiswa_Model();
    }

	public function index()
	{
        $data = [
            'title' => 'Data Mahasiswa',
            'page' => 'Mahasiswa',
            'dataMahasiswa' => $this->mahasiswa_model->findAll()
        ];

        return view('mahasiswa_v', $data);
    }

    public function detail($nim)
    {
        $dataMahasiswa = $this->mahasiswa_model->where('nim', $nim)->first();

        $dataAgama = $this->agama_model->select('agama')->where('kode_agama', $dataMahasiswa['kode_agama'])->first()['agama'];

        $dataHobiMahasiswa = $this->hobimahasiswa_model->where('nim', $nim)->findAll();

        for ($i = 0; $i < count($dataHobiMahasiswa); $i++) { 
            $dataHobi[] = $this->hobi_model->getHobi($dataHobiMahasiswa[$i]['kode_hobi']);
        }
        if (!empty($dataHobi)) {
            sort($dataHobi);
        } else {
            $dataHobi = '';
        }

        $data = [
            'title' => 'Info Mahasiswa',
            'page' => 'Mahasiswa',
            'dataMahasiswa' => $dataMahasiswa,
            'dataAgama' => $dataAgama,
            'dataHobi' => $dataHobi
        ];

        return view('mahasiswa_detail_v', $data);
    }

    public function add()
    {
        session();

        $data = [
            'title' => 'Tambah Mahasiswa',
            'page' => 'Mahasiswa',

            'dataAgama' => $this->agama_model->orderBy('agama', 'asc')->findAll(),
            'dataHobi' => $this->hobi_model->orderBy('hobi', 'asc')->findAll(),

            'validation' => \Config\Services::validation()
        ];

        return view('mahasiswa_form_v', $data);
    }

    public function edit($nim)
    {
        session();

        $hobi_mahasiswa = $this->hobimahasiswa_model->where(['nim' => $nim])->findAll();

        if (count($hobi_mahasiswa) !== 0) {
            foreach ($hobi_mahasiswa as $hobinya) {
                $hobimahasiswa[] = $hobinya['kode_hobi'];
            }
        } else {
            $hobimahasiswa = "";
        }

        $data = [
            'title' => 'Ubah Mahasiswa',
            'page' => 'Mahasiswa',
            
            'mahasiswa' => $this->mahasiswa_model->where(['nim' => $nim])->first(),
            'hobimahasiswa' => $hobimahasiswa,

            'dataAgama' => $this->agama_model->orderBy('agama', 'asc')->findAll(),
            'dataHobi' => $this->hobi_model->orderBy('hobi', 'asc')->findAll(),

            'validation' => \Config\Services::validation(),
        ];

        return view('mahasiswa_form_v', $data);
    }

    public function save()
    {
        
        if ($this->request->getVar('nimTemp')) {
            /* ----- update ----- */

            // cek validasi inputan
            $validate = [
                'nimTemp' => 'required',
                'nama' => [
                    'rules' => 'required|max_length[100]|alpha_space',
                    'errors' => [
                        'required' => 'Nama ga boleh kosong',
                        'max_length' => 'Namanya kepanjangan. Pake nama pendek aja.',
                        'alpha_space' => 'Nama hanya boleh diisi oleh huruf dan spasi'
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir ga boleh kosong.'
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir ga boleh kosong.'
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Maaf, kamu ga punya kelamin :( ?'
                    ]
                ],
                'kode_agama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harus pilih! Ga boleh atheis!'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat ga boleh kosong.'
                    ]
                ],
                'fotoTemp' => 'required',
            ];
            if (!$this->validate($validate)) {
                return redirect()->to(site_url('Mahasiswa/edit/'.$this->request->getVar('nimTemp')))->withInput();
            }

            // upload foto
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $namaFoto = $this->request->getVar('fotoTemp');
            } else {
                $namaFoto = strtolower($this->request->getVar('nimTemp')).'_'.$foto->getName();
                $foto->move('assets/img/mahasiswa', $namaFoto);
                unlink('assets/img/mahasiswa/'.$this->request->getVar('fotoTemp'));
            }

            // proses update data
            $this->mahasiswa_model
                ->whereIn('nim', [$this->request->getVar('nimTemp')])
                ->set([
                        'nama' => ucwords($this->request->getVar('nama')),
                        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                        'kode_agama' => $this->request->getVar('kode_agama'),
                        'alamat' => $this->request->getVar('alamat'),
                        'foto' => $namaFoto,
                        'tempat_lahir' => ucwords($this->request->getVar('tempat_lahir')),
                        'tanggal_lahir' => $this->request->getVar('tanggal_lahir')
                    ])
                ->update()
            ;

            // set session pesan sukses mengubah data
            session()->setFlashdata('pesan', 'Mahasiswa berhasil diubah');

        } else {
            /* i----- insert ----- */

            // cek validasi inputan
            $validate = [
                'nim' => [
                    'rules' => 'required|exact_length[9]|is_unique[mahasiswa.nim]|alpha_numeric',
                    'errors' => [
                        'required' => 'NIM ga boleh kosong',
                        'exact_length' => 'Panjangnya harus 9 digit',
                        'is_unique' => 'NIM sudah terdaftar.',
                        'alpha_numeric' => 'NIM hanya boleh diisi oleh angka dan huruf.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required|max_length[100]|alpha_space',
                    'errors' => [
                        'required' => 'Nama ga boleh kosong',
                        'max_length' => 'Namanya kepanjangan. Pake nama pendek aja.',
                        'alpha_space' => 'Nama hanya boleh diisi oleh huruf dan spasi'
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir ga boleh kosong.'
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir ga boleh kosong.'
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Maaf, kamu ga punya kelamin :( ?'
                    ]
                ],
                'kode_agama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harus pilih! Ga boleh atheis!'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat ga boleh kosong.'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Foto harus diupload :)',
                        'max_size' => 'Maksimal ukuran gambar 1 MB.',
                        'is_image' => 'File harus berupa gambar.',
                        'mime_in' => 'File harus berupa gambar.'
                    ]
                ]
            ];
            if (!$this->validate($validate)) {
                return redirect()->to(site_url('Mahasiswa/add'))->withInput();
            }

            // upload foto
            $foto = $this->request->getFile('foto');
            $namaFoto = strtolower($this->request->getVar('nim')).'_'.$foto->getName();
            $foto->move('assets/img/mahasiswa', $namaFoto);

            // proses insert data
            $this->mahasiswa_model->save([
                'nim' => strtoupper($this->request->getVar('nim')),
                'nama' => ucwords($this->request->getVar('nama')),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'kode_agama' => $this->request->getVar('kode_agama'),
                'alamat' => $this->request->getVar('alamat'),
                'foto' => $namaFoto,
                'tempat_lahir' => ucwords($this->request->getVar('tempat_lahir')),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir')
            ]);

            // set session pesan sukses menambah data
            session()->setFlashdata('pesan', 'Mahasiswa berhasil ditambahkan');

        }

        // variable hobi untuk update hobi
        if ($this->request->getVar('nimTemp')) {
            $nim = $this->request->getVar('nimTemp');
        } else {
            $nim = $this->request->getVar('nim');
        }

        if ($this->request->getVar('hobi')) {

            $hobiLama = $this->hobimahasiswa_model->getKodeHobi($nim);
            $hobiBaru = $this->request->getVar('hobi');

            if (!empty($hobiLama) and !empty($hobiBaru)) {
    
                // jika hobi baru ga ada di hobi lama, tambahkan
                for ($i = 0; $i < count($hobiBaru); $i++) { 
                    if (!in_array($hobiBaru[$i], $hobiLama)) {
                        $this->hobimahasiswa_model->save([
                            'kode_hobi' => $hobiBaru[$i],
                            'nim' => $nim
                        ]);
                    }
                }
    
                // jika hobi lama ga ada di hobi baru, hapus
                for ($i = 0; $i < count($hobiLama); $i++) { 
                    if (!in_array($hobiLama[$i], $hobiBaru)) {
                        // $this->hobimahasiswa_model->save([
                        //     'kode_hobi' => $hobiBaru[$i],
                        //     'nim' => $nim
                        // ]); 
                        $this->hobimahasiswa_model
                        ->where([
                            'kode_hobi' => $hobiLama[$i],
                            'nim' => $nim
                            ])
                        ->delete();
                    }
                }
        
            } else if (!empty($hobiLama) and empty($hobiBaru)) {
                
                // hapus semua hobinya, karena
                // si mahasiswa ini ga punya hobi
                for ($i = 0; $i < count($hobiLama); $i++) {
                    $this->hobimahasiswa_model
                    ->where([
                        'kode_hobi' => $hobiLama[$i],
                        'nim' => $nim
                        ])
                    ->delete();
                }
    
            } else if (empty($hobiLama) and !empty($hobiBaru)) {
    
                // hobi lama kosong, hobi baru ada, tambahkan
                for ($i = 0; $i < count($hobiBaru); $i++) { 
                    $this->hobimahasiswa_model->save([
                        'kode_hobi' => $hobiBaru[$i],
                        'nim' => $nim
                    ]);
                }
            }
        }

        // // update & insert
        // if ($this->request->getVar('hobi')) {    
        //     for ($i = 0; $i < count($this->request->getVar('hobi')); $i++) { 
        //         $this->hobimahasiswa_model->save([
        //             'kode_hobi' => $this->request->getVar('hobi')[$i],
        //             'nim' => $nim
        //         ]);
        //     }
        // }

        // kembali ke halaman Mahasiswa (setelah berhasil update / insert data)
        return redirect()->to(site_url('Mahasiswa'));
    }
    
    public function delete($nim)
    {
        $mahasiswa = $this->mahasiswa_model->where('nim', $nim)->find();

        unlink('assets/img/mahasiswa/'.$mahasiswa[0]['foto']);

        $this->mahasiswa_model->where('nim', $nim)->delete();
        
        session()->setFlashdata('pesan', 'Mahasiswa berhasil dihapus');

        return redirect()->to(site_url('Mahasiswa'));
    }


}
