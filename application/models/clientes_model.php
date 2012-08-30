<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('clientes', $data);
    }
    
    function listar(){
        $query = $this->db->get('clientes');
        return $query->result();
    }
    
    function deletar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('clientes');
    }
    
    function editar($id) {
        $this->db->where('id', $id);
        return $this->db->get('clientes')->result();
    }
    
    function alterar($data) {
        $this->db->where('id', $data['id']);
        $this->db->set($data);
        return $this->db->update('clientes');
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