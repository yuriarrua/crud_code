<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('categorias', $data);
    }
    
    function listar(){
        $query = $this->db->get('categorias');
        return $query->result();
    }
    
    function deletar($id) {
        $this->db->where('id_cat', $id);
        return $this->db->delete('categorias');
    }
    
    function editar($id) {
        $this->db->where('id_cat', $id);
        return $this->db->get('categorias')->result();
    }
    
    function alterar($data) {
        $this->db->where('id_cat', $data['id_cat']);
        $this->db->set($data);
        return $this->db->update('categorias');
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