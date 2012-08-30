<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class categorias extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        //Carregar o debug
        //$this->output->enable_profiler(TRUE);
    }
    
    function index(){
        $data['titulo'] = "Testando o CRUD";
        $data['pagina'] = "categorias/categorias";
        $this->load->model('categorias_model');
        $data['categorias'] = $this->categorias_model->listar();
        
        $this->load->view('template', $data);
    }
    
    function pagina(){
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('categorias_model');
        
        $config['base_url'] = base_url().'index.php/categorias/pagina/';
        $config['total_rows'] = $this->categorias_model->count('categorias');
        $config['per_page'] = 10;	
        
        $this->pagination->initialize($config);
        
	$this->data['results'] = $this->categorias_model->get('categorias','id_cat,categoria','',$config['per_page'],$this->uri->segment(3));
        $this->data['titulo'] = "Lista de categorias";
        $this->data['pagina'] = "categorias/lista";
                
	$this->load->view('template', $this->data);
    }
    
    function listar(){
        $this->pagina();
    }
    
    function cadastrar(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'categoria',
                'label' => 'Categoria',
                'rules' => 'required|min_length[4]|max_length[45]'
            )
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['categoria'] = $this->input->post('categoria');

            $this->load->model('categorias_model');
            if ($this->categorias_model->cadastrar($data)) {
                redirect('categorias');
            } else {
                log_message('error', 'Erro no cadastro...');
            }
        }
    }
    
    function deletar($id) {
        $this->load->model('categorias_model');
        if ($this->categorias_model->deletar($id)) {
            redirect('categorias/listar');
        } else {
            log_message('error', 'Erro ao deletar...');
        }
    }
    
    function editar($id)  {
        $data['titulo'] = "CRUD | Alteração de categorias";
        $data['pagina'] = "categorias/categorias_edit";
        $this->load->model('categorias_model');
        $data['dados_categorias'] = $this->categorias_model->editar($id);

        $this->load->view('template', $data);
    }
    
    function alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'categoria',
                'label' => 'Categoria',
                'rules' => 'required|min_length[4]|max_length[45]'
            )
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->input->post('id'));
        } else {
            $data['id_cat'] = $this->input->post('id');
            $data['categoria'] = $this->input->post('categoria');

            $this->load->model('categorias_model');
            if ($this->categorias_model->alterar($data)) {
                redirect('categorias/listar');
            } else {
                log_message('error', 'Erro na alteração...');
            }
        }
    }
}

?>