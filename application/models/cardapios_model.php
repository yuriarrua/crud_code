<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Cardapios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('cardapios', $data);
    }
    
    function listar(){
        $query = $this->db->get('cardapios');
        return $query->result();
    }
    
    function deletar($id) {
        $this->db->where('id_cardapio', $id);
        return $this->db->delete('cardapios');
    }
    
    function editar($id) {
        $this->db->where('id_cardapio', $id);
        return $this->db->get('cardapios')->result();
    }
    
    function alterar($data) {
        if($data['ativo'] == 1){
            $this->db->query("update cardapios set ativo=0");
        }
        $this->db->where('id_cardapio', $data['id_cardapio']);
        $this->db->set($data);
        return $this->db->update('cardapios');
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