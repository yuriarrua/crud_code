<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Itens_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cadastrar($data) {
        return $this->db->insert('itens', $data);
    }
    
    function listar(){
        $this->db->select('*');
        $this->db->from('itens');
        $this->db->join('categorias', 'categorias.id_cat = itens.id_categoria', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
    
    function deletar($id) {
        $this->db->where('id_item', $id);
        return $this->db->delete('itens');
    }
    
    function editar($id) {
        $this->db->where('id_item', $id);
        return $this->db->get('itens')->result();
    }
    
    function alterar($data) {
        $this->db->where('id_item', $data['id_item']);
        $this->db->set($data);
        return $this->db->update('itens');
    }
    function count($table){
	return $this->db->count_all($table);            
    }
    function get($table,$fields,$where='',$perpage=0,$start=0){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('categorias', 'categorias.id_cat = itens.id_categoria', 'inner');
        $this->db->limit($perpage,$start);
        if($where){
        $this->db->where($where);
        }
        
        $query = $this->db->get();

        $result =  $query->result() ;
        return $result;
    }
    function contar(){
      return $this->db->count_all('itens'); 
    }
}