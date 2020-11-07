<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class Auth_Filter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = NULL)
  {
    if (!session('userid')) {
      session()->setFlashdata('pesan', 'login dulu kuyy');
      return redirect()->to('/masuk');
    }
    // Do something here
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
  {
      // Do something here
  }
}