<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class itens extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        //Carregar o debug
        //$this->output->enable_profiler(TRUE);
    }
    
    function index(){
        $data['titulo'] = "Testando o CRUD";
        $data['pagina'] = "itens/itens";
        $this->load->model('itens_model');
        $this->load->model('categorias_model');
        $data['itens'] = $this->itens_model->listar();
        $data['categorias'] = $this->categorias_model->listar();
        
        $this->load->view('template', $data);
    }
    
    function pagina(){
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('itens_model');
        
        $config['base_url'] = base_url().'index.php/itens/pagina/';
        $config['total_rows'] = $this->itens_model->count('itens');
        $config['per_page'] = 10;	
        
        $this->pagination->initialize($config);
        
	$this->data['results'] = $this->itens_model->get('itens','*','',$config['per_page'],$this->uri->segment(3));
        $this->data['titulo'] = "Lista de itens";
        $this->data['pagina'] = "itens/lista";
                
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
                'field' => 'item',
                'label' => 'Item',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'preco',
                'label' => 'Preço',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required|min_length[4]'
            )
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['item'] = $this->input->post('item');
            $data['id_categoria'] = $this->input->post('categoria');
            $data['id_pizzaria'] = $this->input->post('id_pizzaria');
            $data['preco'] = $this->input->post('preco');
            $data['descricao'] = $this->input->post('descricao');
            
            $this->load->model('itens_model');
            if ($this->itens_model->cadastrar($data)) {
                redirect('itens');
            } else {
                log_message('error', 'Erro no cadastro...');
            }
        }
    }
    
    function add(){
        $data['titulo'] = "cadastre uma nova categoria";
        $this->load->model('itens_model');
        $this->load->model('categorias_model');
        $data['itens'] = $this->itens_model->listar();
        $data['categorias'] = $this->categorias_model->listar();
        
        $this->load->view('categorias/add', $data);
    }
    
    function cadastrar_categoria(){
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
                  redirect('itens/add');
            } else {
                log_message('error', 'Erro no cadastro...');
            }
        }
    }
    
   function deletar($id) {
        $this->load->model('itens_model');
        if ($this->itens_model->deletar($id)) {
            redirect('itens/listar');
        } else {
            log_message('error', 'Erro ao deletar...');
        }
    }
    
    function editar($id)  {
        $data['titulo'] = "CRUD | Alteração de itens";
        $data['pagina'] = "itens/itens_edit";
        $this->load->model('categorias_model');
        $this->load->model('itens_model');
        $data['dados_itens'] = $this->itens_model->editar($id);
        $data['categorias'] = $this->categorias_model->listar();

        $this->load->view('template', $data);
    }
    
    function alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'item',
                'label' => 'Item',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'preco',
                'label' => 'Preço',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required|min_length[4]'
            )
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->input->post('id'));
        } else {
            $data['id_item'] = $this->input->post('id');
            $data['item'] = $this->input->post('item');
            $data['id_categoria'] = $this->input->post('categoria');
            $data['preco'] = $this->input->post('preco');
            $data['descricao'] = $this->input->post('descricao');
            
            $this->load->model('itens_model');
            if ($this->itens_model->alterar($data)) {
                redirect('itens/listar');
            } else {
                log_message('error', 'Erro na alteração...');
            }
        }
    }
}

?>