<?php namespace App\Controllers;

use App\Models\Pelajar_Model;
use App\Models\Quiz_Model;

class Quiz extends BaseController
{
  public $username;
  private $password;

  public function __construct()
  {
    $this->pelajar = new Pelajar_Model;
    $this->quiz = new Quiz_Model;
  }

	public function index()
	{
		return view('quiz/index');
  }

  public function quiz()
  {
    if ($this->request->isAJAX()) {
      $waktu = $this->request->getPost('waktu');
      $skor = $this->request->getPost('skor');

      if ($this->quiz->getData(session()->get('userid'))) {
        $this->quiz->where(['id_pelajar' => $this->quiz->getData(session()->get('userid'))])
        ->set([
          'nilai_quiz' => $skor,
          'waktu_quiz' => $waktu
        ])
        ->update();
      } else {
        $this->quiz->save([
          'id_pelajar' => session()->get('userid'),
          'nilai_quiz' => $skor,
          'waktu_quiz' => $waktu
        ]);
      }

      // session()->setFlashdata('pesan', 'Berhasil update skor');
      // return redirect()->to('/beranda');

      // return json_encode([
      //   'success'=> 'success',
      //   'waktu' => $waktu,
      //   'skor' => $skor
      // ]);
    }
  }
  
  public function beranda()
  {
    return view('beranda');
  }

	//--------------------------------------------------------------------

}
