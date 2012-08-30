<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class clientes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        //Carregar o debug
        //$this->output->enable_profiler(TRUE);
    }
    
    function index(){
        $data['titulo'] = "Testando o CRUD";
        $data['pagina'] = "clientes/clientes";
        $this->load->model('clientes_model');
        $data['clientes'] = $this->clientes_model->listar();
        
        $this->load->view('template', $data);
    }
    
    function pagina(){
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('clientes_model');
        
        $config['base_url'] = base_url().'index.php/clientes/pagina/';
        $config['total_rows'] = $this->clientes_model->count('clientes');
        $config['per_page'] = 1;	
        
        $this->pagination->initialize($config);
        
	$this->data['results'] = $this->clientes_model->get('clientes','id,nome,endereco,horario,descricao','',$config['per_page'],$this->uri->segment(3));
        $this->data['titulo'] = "Lista de clientes";
        $this->data['pagina'] = "clientes/lista";
                
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
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'endereco',
                'label' => 'Endereço',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['nome'] = $this->input->post('nome');
            $data['endereco'] = $this->input->post('endereco');

            $this->load->model('Clientes_model');
            if ($this->Clientes_model->cadastrar($data)) {
                redirect('clientes');
            } else {
                log_message('error', 'Erro no cadastro...');
            }
        }
    }
    
    function deletar($id) {
        $this->load->model('clientes_model');
        if ($this->clientes_model->deletar($id)) {
            redirect('clientes/listar');
        } else {
            log_message('error', 'Erro ao deletar...');
        }
    }
    
    function editar($id)  {
        $data['titulo'] = "CRUD | Alteração de Clientes";
        $data['pagina'] = "clientes/clientes_edit";
        $this->load->model('clientes_model');
        $data['dados_cliente'] = $this->clientes_model->editar($id);

        $this->load->view('template', $data);
    }
    
    function alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'endereco',
                'label' => 'Endereço',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->input->post('id'));
        } else {
            $data['id'] = $this->input->post('id');
            $data['nome'] = $this->input->post('nome');
            $data['endereco'] = $this->input->post('endereco');

            $this->load->model('clientes_model');
            if ($this->clientes_model->alterar($data)) {
                redirect('clientes/listar');
            } else {
                log_message('error', 'Erro na alteração...');
            }
        }
    }
}

?>