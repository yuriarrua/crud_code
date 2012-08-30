<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	public function registro()
	{
		$this->load->view('header_view');
		$this->load->view('usuario/registro_view');
		$this->load->view('footer_view');
	}
	
	public function checa_registro()
	{
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome Completo', 'required|max_length[255]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[15]|matches[senha1]');
		$this->form_validation->set_rules('senha1', 'Confirmar Senha', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('header_view');
			$this->load->view('usuario/registro_view');
			$this->load->view('footer_view');
		}else{
			$usuario['nome'] = $this->input->post('nome');
			$usuario['email'] = $this->input->post('email');
			$usuario['senha'] = md5($this->input->post('senha'));
			$this->load->model('usuario_model');
			$this->usuario_model->GravaUsuario($usuario);
			$id = $this->db->insert_id();
			$this->usuario_model->GravaDetalhe($id);
			
			$ativacao['token'] = md5(time().$this->input->post('nome'));//Gera token de ativacao
			$ativacao['email'] = $this->input->post('email');//E-mail para ativacao
			
			if($this->usuario_model->GravaToken($ativacao)){
				//Envio de e-mail de ativação
				$this->load->library('email');
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('contato@seudominio.com.br', 'SeuSite');
				$this->email->to($this->input->post('email')); 
				$this->email->subject('Ative sua Conta no SeuSite');
			
				$mensagem = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
				$mensagem.= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
				$mensagem.= "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
				$mensagem.= "<title>Untitled Document</title>\n</head>\n<body>";
				$mensagem.= "		<p>Olá ".$this->input->post('nome')."<br />\n        Seja Bem Vindo ao <strong>SeuSite</strong></p>\n";
				$mensagem.= "       <p>Ative sua conta pelo link:<br />\n";
				$mensagem.= "        <a href=\"http://www.seudominio.com.br/usuario/ativacao/".$ativacao['token']."\">http://www.seudominio.com.br/usuario/ativacao/".$ativacao['token']."</a></p>\n";
				$mensagem.= "        <p>Obrigado por registrar-se!</p>\n        <p><i><strong>Equipe SeuSite</strong><br />\n";
				$mensagem.= "        <a href=\"".base_url()."\">".base_url()."</a><br />\n";
				$mensagem.= "        <a href=\"mailto:contato@seudominio.com.br\">contato@seudominio.com.br</a></i></p>\n";
				$mensagem.= "	</body>\n</html>\n";
				$this->email->message($mensagem);
				$this->email->send();
			}
		
			$this->load->view('header_view');
			$this->load->view('usuario/registro_ok_view');
			$this->load->view('footer_view');
		}
	
	}
	
	public function ativacao(){
		
		$token = $this->uri->segment(3, 0);
		$this->load->model('usuario_model');//Carrega o model da view de conteudo
		if($query = $this->usuario_model->VerificaToken($token)){//Se retornar Verdadeiro o token
			$usuario = $query->hl_email;
			$this->usuario_model->AtivaAssinante($usuario);
			$this->load->view('usuario/confirmacao_view', $usuario);//Carrega a view de conteudo dentro da pasta view/assinante
		}else{
			$this->load->view('usuario/confirmacao_view', $token);//Carrega a view de conteudo dentro da pasta view/assinante
		}
		
		$this->load->view('footer_view');//carrega do rodapé
		
	}
	
	public function solicita_senha()
	{
	
		$this->load->view('header_view');
		$this->load->view('usuario/solicita_senha_view');
		$this->load->view('footer_view');
	
	}
	
	public function gera_senha()
	{
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_email_check1');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('header_view');
			$this->load->view('usuario/solicita_senha_view');
			$this->load->view('footer_view');
		}else{
			$nova_senha = $this->gera_pass();
			$user['email'] = $this->input->post('email');
			$user['senha'] = md5($nova_senha);
			$this->load->model('usuario_model');
			$this->usuario_model->GravaNovaSenha($user);
			
			$this->load->library('email');
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from('sac@seudominio.com.br', 'SeuSite');
			$this->email->to($this->input->post('email')); 
			$this->email->subject('Nova Senha');
			$mensagem = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
			$mensagem.= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
			$mensagem.= "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
			$mensagem.= "<title>Untitled Document</title>\n</head>\n<body>";
			$mensagem.= "		<p>Olá ".$this->input->post('email')."<br />\n        Sua nova senha foi gerada.</p>\n";
			$mensagem.= "       <p>Nova senha de acesso: <strong>".$nova_senha."</strong></p>\n";
			$mensagem.= "        <p>Obrigado por registrar-se!</p>\n        <p><i><strong>Equipe SeuSite</strong><br />\n";
			$mensagem.= "        <a href=\"".base_url()."\">".base_url()."</a><br />\n";
			$mensagem.= "        <a href=\"mailto:sac@seudominio.com.br\">sac@seudominio.com.br</a></i></p>\n";
			$mensagem.= "	</body>\n</html>\n";
			
			$this->email->message($mensagem);
			$this->email->send();
			
			$this->load->view('header_view');
			$this->load->view('usuario/senha_enviada_view');
			$this->load->view('footer_view');
		}
	
	}
	
	public function perfil()
	{
		
		$this->check_user_logged();
		$this->load->view('header_view');
		
		$this->load->model('usuario_model');
		$dados['id'] = $this->usuario_model->GetUserID($this->session->userdata('login'));
		$dados['user'] = $this->usuario_model->verificaEmail($this->session->userdata('login'));
		$dados['detalhe'] = $this->usuario_model->GetUserDetalhe($dados['id']->id_user);
		$this->load->view('usuario/perfil_view', $dados);
		$this->load->view('footer_view');
	
	}
	
	function email_check($email)
	{
		$this->load->model('usuario_model');//Carrega o model usuario_Model
		if ($this->usuario_model->verificaEmail($email))
		{
			$this->form_validation->set_message('email_check', 'O E-mail escolhido já está em uso.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function email_check1($email)
	{
		$this->load->model('usuario_model');//Carrega o model usuario_Model
		if ($this->usuario_model->verificaEmail($email))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_check1', 'O E-mail informado n&atilde;o está cadastrado.');
			return FALSE;
		}
	}
	
	function gera_pass(){
		$CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyz0123456789'; 
		$max = strlen($CaracteresAceitos)-1;
		$password = null;
		for($i=0; $i < 6; $i++) { 
			$password .= $CaracteresAceitos{mt_rand(0, $max)}; 
		}
		return $password;
	}
	
	function check_user_logged(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('login');
		}
	}

}

?>