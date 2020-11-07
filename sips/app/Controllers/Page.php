<?php namespace App\Controllers;

class Page extends BaseController
{
	public function index()
	{
		return view('welcome_message');
  }
  
  public function beranda()
  {
    $data = [
      'title' => 'Beranda',
      'validation' => \Config\Services::validation(),
    ];
    
    session()->setFlashdata('alert', ['tipe' => 'success', 'pesan' => 'Selamat datang!']);
    return view('beranda', $data);
  }
  
  public function materi()
  {
    return view('materi');
  }
  
  public function latihan()
  {
    return view('latihan');
  }
  
  public function quiz()
  {
    return view('quiz');
  }
  
  public function peringkat()
  {
    return view('peringkat');
  }

	//--------------------------------------------------------------------

}
