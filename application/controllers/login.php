<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }
	   
	function index(){
            $data['titulo'] = "Testando o CRUD";
            $data['pagina'] = "login_view";
            $data['msg'] = "";
            $this->load->model('login_model');
            
            $this->load->view('template', $data);
        }
       
       
	
	public function valida(){
	
		$this->load->model('login_model');//Carrega o model
		$query = $this->login_model->ValidaLogin();//Chama a função da Model que checa o usuário no BD
		
		if($query) //Se o Usuário e senha existir no mesmo registro...
		{
                    foreach($query as $user):
                                           
			$data = array(
				'login' => $this->input->post('email'),
				'is_logged_in' => true,
                                'id_user' => $user->id_user
			);
			$this->session->set_userdata($data);
                   endforeach;
			redirect('home');
		}else // incorrect username or password
		{
			$data['msg'] = "Informações incorretas";
			$data['titulo'] = "Testando o CRUD";
                        $data['pagina'] = "login_view";
                        $this->load->model('login_model');
            
                        $this->load->view('template', $data);
		}
	
	}
	
	public function logout(){
	
		if($this->session->userdata('is_logged_in')){
			$this->session->sess_destroy();
			redirect('login');
		}
		
	}

}

?>