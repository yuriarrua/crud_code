<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Pizzarias_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }

		
    function upload(){
        //Configurações necessárias para fazer upload do arquivo

        //Pasta onde será feito o upload
        $base = base_url();
        $config['upload_path'] = $base.'logos/';
        //Tipos suportados
        $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|csv';
        //Configurando atributos do arquivo imagem que iremos receber
        $config['max_size']	= '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config["overwrite"] = TRUE;

        //Carregando a lib com as configurações feitas
        $this->upload->initialize($config);
        //$this->load->library('upload', $config);

        //Fazendo o upload do arquivo e direcionando para a view de erro ou de sucesso
        if( ! $this->upload->do_upload('userfile')){
            print_r($this->upload->data('userfile'));
            $error = array('error' => $this->upload->display_errors());

            print_r($error);
            echo $config['upload_path'];
        }
        else
        {
            $this->cadastrar($data);
        }
    }

    function cadastrar($dados) {
        return $this->db->insert('pizzarias', $dados);
    }
    
    function listar(){
        $query = $this->db->get('pizzarias');
        return $query->result();
    }
    
    function deletar($id) {
        $this->db->where('id_pizzaria', $id);
        return $this->db->delete('pizzarias');
    }
    
    function editar($id) {
        $this->db->where('id_pizzaria', $id);
        return $this->db->get('pizzarias')->result();
    }
    
    function alterar($data) {
        $this->db->where('id_pizzaria', $data['id_pizzaria']);
        $this->db->set($data);
        return $this->db->update('pizzarias');
    }
    function alterar_com_imagem($data) {
        $this->db->where('id_pizzaria', $data['id_pizzaria']);
        $this->db->set($data);
        return $this->db->update('pizzarias');
    }
    function count($table){
	return $this->db->count_all($table);            
    }
    function get($table,$fields,$where='',$perpage=0,$start=0){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
        $this->db->where($where);
     }
        
        $query = $this->db->get();

        $result =  $query->result() ;
        return $result;
    }
}