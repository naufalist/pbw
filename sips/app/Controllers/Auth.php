<?php namespace App\Controllers;

use App\Models\Pelajar_Model;

class Auth extends BaseController
{
  public $username;
  private $password;

  public function __construct()
  {
    $this->pelajar = new Pelajar_Model;
  }
	public function index()
	{
		return view('welcome_message');
  }

  public function daftar()
  {
    $data = [
        'title' => 'Daftar',
        'validation' => \Config\Services::validation()
    ];

    return view('auth/daftar', $data);
  }

  public function daftarProses()
  {
    $email = $this->request->getVar('email');
    $nama = $this->request->getVar('nama');
    $password = $this->request->getVar('password');
    $repassword = $this->request->getVar('repassword');
    $organisasi = $this->request->getVar('organisasi');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email|is_unique[pelajar.email]',
        'errors' =>  [
          'required' => '{field} harus diisi.',
          'valid_email' => '{field} harus valid.',
          'is_unique' => '{field} harus unik'
        ]
      ],
      'nama' => [
        'rules' => 'required|alpha_space|min_length[3]|max_length[30]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'alpha_space' => '{field} hanya boleh huruf dan spasi',
          'min_length' => '{field} min 3',
          'max_length' => '{field} maks 50',
          ]
      ],
      'password' => [
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 6'
          ]
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'matches' => '{field} tidak sama dgn atas'
          ]
      ],
      'organisasi' => [
        'rules' => 'required|alpha_numeric_space|max_length[30]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'alpha_numeric_space' => '{field} harus huruf / angka',
          'max_length' => '{field} max 30'
          ]
      ],
    ])) {
      return redirect()->to('/daftar')->withInput();
    }

    $token_aktivasi = $this->getToken(100);
    $this->pelajar->save([
      'email' => $email,
      'nama' => $nama,
      'katasandi' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]),
      'organisasi' => $organisasi,
      'aktivasi' => 0,
      'token_aktivasi' => $token_aktivasi
    ]);
    
    $this->kirimEmail('verifikasi', $email, $token_aktivasi);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan. Silakan cek email untuk melakukan aktivasi akun');

    return redirect()->to('/masuk');

  }

  public function verifikasi($token_yang_dikirim, $id_pelajar)
  {
    $token_di_db = $this->pelajar->getToken($id_pelajar);

    if ($token_di_db and ($token_di_db === $token_yang_dikirim)) {
      // token sesuai
      $this->pelajar
      ->where(['id_pelajar' => $id_pelajar])
      ->set([
        'aktivasi' => 1,
        'token_aktivasi' => null
        ])
      ->update();
      // set flash data
      session()->setFlashdata('pesan', 'Berhasil verifikasi, silakan login');
      return redirect()->to('/masuk')->withInput();
    } else {
      // set flash data
      session()->setFlashdata('pesan', 'Gagal verifikasi, silakan hubungi admin');
      return redirect()->to('/masuk')->withInput();
    }

  }

  public function masuk()
  {
    // session();

    // ga bisa lewat middleware :'), ga paham,
    // terpaksa didefinisi-in disini deh
    if (session('userid')) {
      return redirect()->to('/beranda');
    }
    
    $data = [
        'title' => 'Masuk',
        'validation' => \Config\Services::validation()
    ];

    return view('auth/masuk', $data);
  }

  public function masukProses()
  {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email',
        'errors' =>  [
          'required' => '{field} harus diisi.',
          'valid_email' => '{field} harus valid.'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
          ]
      ]
    ])) {
      return redirect()->to('/masuk')->withInput();
    }

    // cek email
    if ($this->pelajar->getData($email, 'email')) {
      // cek katasandi
      if (password_verify($password, $this->pelajar->getData($email, 'katasandi'))) {
        // cek aktivasi
        if ($this->pelajar->getData($email, 'aktivasi') === "1") {
          // set session
          session()->set("userid", $this->pelajar->getData($email, 'id_pelajar'));
          // session()->markAsTempdata('userid', 10);
          return redirect()->to('/beranda');
        } else {
          // belum verifikasi
          session()->setFlashdata('pesan', 'Silakan verifikasi dulu');
          return redirect()->to('/masuk')->withInput();
        }
      } else {
        // password salah
        session()->setFlashdata('pesan', 'Email benar, pass salah.');
        return redirect()->to('/masuk')->withInput();
      }
    } else {
      // email tidak terdaftar
      session()->setFlashdata('pesan', 'email salah');
      return redirect()->to('/masuk')->withInput();
    }
  }

  public function keluar()
  {
    // session()->destroy();
    session()->remove('userid');
    
    session()->setFlashdata('pesan', 'berhasil keluar');
    return redirect()->to('/masuk');
  }

  public function lupaKatasandi()
  {
    $data = [
        'title' => 'Lupa Katasandi',
        'validation' => \Config\Services::validation()
    ];

    return view('auth/lupa_katasandi', $data);
  }

  public function lupaKatasandiProses()
  {
    $email = $this->request->getVar('email');
    $email_di_db = $this->pelajar->getData($email, 'email');
    
    if (!$this->validate([
      'email' => [
        'rules' => 'required|valid_email',
        'errors' =>  [
          'required' => '{field} harus diisi.',
          'valid_email' => '{field} harus valid.'
        ]
      ]
    ])) {
      return redirect()->to('/lupa_katasandi')->withInput();
    }

    // jika email sesuai
    if ($email_di_db and ($email_di_db === $email)) {
      // cek token, udah ada atau belum
      if (!$this->pelajar->getData($email, 'token_lupa_katasandi')) {
        $token_lupa_katasandi = $this->getToken(100);
        $this->pelajar
        ->where(['id_pelajar' => $this->pelajar->getData($email, 'id_pelajar')])
        ->set([
          'token_lupa_katasandi' => $token_lupa_katasandi
          ])
        ->update();
      } else {
        // kalau udah ada, ambil aja datanya
        $token_lupa_katasandi = $this->pelajar->getData($email, 'token_lupa_katasandi');
      }

      $this->kirimEmail('lupa_katasandi', $email, $token_lupa_katasandi);

      session()->setFlashdata('pesan', 'Silakan cek email');
      return redirect()->to('/masuk');

    } else {
      session()->setFlashdata('pesan', 'Gagal verifikasi, email salah');
      return redirect()->to('/lupa_katasandi')->withInput();
    }

  }

  public function ubahKatasandi($token_lupa_katasandi = '', $id_pelajar = '')
  {
    if (!empty($token_lupa_katasandi) and !empty($id_pelajar)) {
      $token_lupa_katasandi_di_db = $this->pelajar->getDataById($id_pelajar, 'token_lupa_katasandi');
      if ($token_lupa_katasandi_di_db and ($token_lupa_katasandi_di_db === $token_lupa_katasandi)) {
        
        $data = [
            'title' => 'Ubah Katasandi',
            'validation' => \Config\Services::validation(),
            'id' => $id_pelajar,
            'token' => $token_lupa_katasandi_di_db
        ];

        return view('auth/ubah_katasandi', $data);

      } else {
        session()->setFlashdata('pesan', 'Token tidak valid');
        return redirect()->to('/lupa_katasandi');
      }
    } else {
        session()->setFlashdata('pesan', 'Silakan kirim email terlebih dahulu');
        return redirect()->to('/lupa_katasandi');
    }

    // $data = [
    //     'title' => 'Ubah Katasandi',
    //     'validation' => \Config\Services::validation()
    // ];

    // return view('auth/ubah_katasandi', $data);
  }

  public function ubahKatasandiProses()
  {
    // if ($this->request->getVar('id') and
    //       $this->request->getVar('password') and
    //       $this->request->getVar('repassword') and
    //       $this->request->getVar('token')) {

    //       if (!$this->validate([
    //         'password' => [
    //           'rules' => 'required|min_length[6]',
    //           'errors' => [
    //             'required' => '{field} harus diisi.',
    //             'min_length' => '{field} minimal 6'
    //             ]
    //         ],
    //         'repassword' => [
    //           'rules' => 'required|matches[password]',
    //           'errors' => [
    //             'required' => '{field} harus diisi.',
    //             'matches' => '{field} tidak sama dgn atas'
    //             ]
    //         ],
    //       ])) {
    //         return redirect()->to('ubah_katasandi/'.$this->request->getVar('token').'/'.$this->request->getVar('id'))->withInput();
    //       }
    //   }

    $id_pelajar = $this->request->getVar('id');
    $token_lupa_katasandi = $this->request->getVar('token');
    $password = $this->request->getVar('password');
    $repassword = $this->request->getVar('repassword');

    if (!$this->validate([
      'id' => [
        'rules' => 'required',
        'errors' =>  [
          'required' => '{field} harus diisi.',
        ]
      ],
      'token' => [
        'rules' => 'required',
        'errors' =>  [
          'required' => '{field} harus diisi.',
        ]
      ],
      'password' => [
        'rules' => 'required|min_length[6]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 6'
          ]
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'matches' => '{field} tidak sama dgn atas'
          ]
      ]
    ])) {
      return redirect()->to('ubah_katasandi/'.$token_lupa_katasandi.'/'.$id_pelajar)->withInput();
      // return redirect()->to('/ubah_katasandi')->withInput();
    }

    // ubah katasandi
    $this->pelajar
    ->where(['id_pelajar' => $id_pelajar])
    ->set([
      'katasandi' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]),
      'token_lupa_katasandi' => null
      ])
    ->update();
    
    session()->setFlashdata('pesan', 'Berhasil ubah katasandi. Silakan login');
    return redirect()->to('/masuk');

  }

  public function crypto_rand_secure($min, $max)
  {
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
  }

  public function getToken($length)
  {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited
    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
    }
    return $token;
  }

  public function kirimEmail($mode, $email, $token)
  {

    $id_pelajar = $this->pelajar->getData($email, 'id_pelajar');
    // potong nama
    $nama = $this->pelajar->getData($email, 'nama');
    $namaPendek = explode(" ",$nama);
    if (count($namaPendek) >= 2) {
        $nama = $namaPendek[0]." ".$namaPendek[1];
    } else {
        $nama = $namaPendek[0];
    }

    // cek mode kirimnya, verifikasi atau lupa katasandi
    // disini buat bedain pesan body-nya
    if ($mode == 'verifikasi') {
      $subjek = 'Verifikasi Akun SIPS';
      $link = site_url('/verifikasi/'.$token.'/'.$id_pelajar);
      $pesan = '
        <h2>Hai, '.$nama.'!
        <h3>Silakan klik link ini untuk melakukan verifikasi: <a href="'.$link.'">Verifikasi</a></h3>
        <h3>Terima kasih</h3>
    ';
    } else if ($mode == 'lupa_katasandi') {
      $subjek = 'Permintaan Ubah Katasandi Akun SIPS';
      $link = site_url('/ubah_katasandi/'.$token.'/'.$id_pelajar);
      $pesan = '
        <h2>Hai, '.$nama.'!
        <h3>Silakan klik link ini untuk mengatur ulang katasandi: <a href="'.$link.'">Atur ulang katasandi</a></h3>
        <h3>Terima kasih</h3>
    ';
    }

    // dd($link_verifikasi);
    $this->email = \Config\Services::email();
		$this->email->setFrom('no-reply@naufalist.com','Naufal');
		$this->email->setTo($email);
		// $this->email->attach($attachment);
		$this->email->setSubject($subjek);
		$this->email->setMessage($pesan);

		if (!$this->email->send()){
			return "false";
		} else {
			return "true";
		}
	}

	//--------------------------------------------------------------------

}
