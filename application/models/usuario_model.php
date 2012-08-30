<?php

class Usuario_model extends CI_Model{
	
	 //atributo que referencia o nome da tabela que desejamos acessar
		private $tabela = 'pessoa';
		
		/* Construtor da classe
		 * Devemos sempre chamar o construtor da classe pai, no caso CI_Model
		 */
		function __construct(){
			parent::__construct();
		}

		/* Método responsável por atualizar os dados de uma pessoa
		 * Devemos atribuir o id do pessoa que queremos atualizar
		 * e o CI se responsabiliza por fazer a atualização
		 */
		function atualizar($id, $pessoa){
			$this->db->where('id', $id);
			$this->db->update($this->tabela, $pessoa);
		}
		
		/* Método responsável por deletar uma pessoa
		 * Assim como no método atualizar, ele referencia o id
		 * e depois apaga o pessoa de acordo com seu id passado
		 */
		function deletar($id){
			$this->db->where('id', $id);
			$this->db->delete($this->tabela);
		}
		
		/* Adiciona uma novo pessoa à tabela
		 * Bem intuitivo, passamos a tabela e o objeto pessoa
		 * que estamos adicionando
		 */
		function inserir($pessoa){
			return $this->db->insert($this->tabela, $pessoa);
		}
		
		/* Método que recupera a lista de todos as pessoas
		 * cadastrados na tabela ordenando pelo atributo "nome"
		 * 
		 */
		function getPessoas(){
			$this->db->order_by('nome', 'asc');
			return $this->db->get($this->tabela);
		}
		
		/* Método que recupera uma pessoa específica de 
		 * acordo com seu id
		 */
		function getById($id){
			$this->db->where('id', $id);
			return 	$this->db->get($this->tabela);
		}	

	function GravaUsuario($usuario){
		$this->db->set('nm_nome', $usuario['nome']);
		$this->db->set('hl_email', $usuario['email']);
		$this->db->set('pw_password', $usuario['senha']);
		$this->db->set('dt_cadastro', date("Y-m-d", time()));
		return $this->db->insert('tb_user');
	}
	
	function GravaDetalhe($id){
		$dir = site_url('libraries/img/');
		$this->db->set('id_user', $id);
		$this->db->set('hl_imagem', '$dir'.'default-user.jpg');
		return $this->db->insert('tb_user_detalhe');
	}
	
	function verificaEmail($email){
		$this->db->where('hl_email', $email);
		$sql = $this->db->get('tb_user');
		return $sql->result();
	}
	
	function GravaNovaSenha($user){
		$this->db->set('pw_password', $user['senha']);
		$this->db->where('hl_email', $user['email']);
		$this->db->update('tb_user');
	}
	
	function GetUserID($email){
		$this->db->where('hl_email', $email);
		$sql = $this->db->get('tb_user');
		return $sql->row(0);
	}
	
	function GetUserDetalhe($id){
		$this->db->where('id_user', $id);
		$sql = $this->db->get('tb_user_detalhe');
		return $sql->result();
	}
	
	function GravaToken($ativacao){
		$this->db->set('nu_token', $ativacao['token']);
		$this->db->set('hl_email', $ativacao['email']);
		return $this->db->insert('tb_user_ativacao');
	}
	
	function VerificaToken($token){
		$this->db->where('nu_token', $token);
		$sql = $this->db->get('tb_user_ativacao');
		return $sql->row();
	}
	
	function AtivaAssinante($assinante){
		$this->db->where('hl_email', $assinante);
		$this->db->delete('tb_user_ativacao');
		$this->db->where('hl_email', $assinante);
		$data = array('fl_status' => '1');
		$this->db->update('tb_user', $data); 
	}

}

?>