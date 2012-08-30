<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class cardapios extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        //Carregar o debug
        //$this->output->enable_profiler(TRUE);
    }
    
    function index(){
        $data['titulo'] = "Testando o CRUD";
        $data['pagina'] = "cardapios/cardapios";
        $this->load->model('cardapios_model');
        $this->load->model('itens_model');
        $data['cardapios'] = $this->cardapios_model->listar();
        $data['itens'] = $this->itens_model->listar();
        
        $this->load->view('template', $data);
    }
    
    function pagina(){
        $this->load->library('breadcrumb');
        $this->breadcrumb->append_crumb('Home', '/');
        $this->breadcrumb->append_crumb('Page', '/page');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('cardapios_model');
        
        $config['base_url'] = base_url().'index.php/cardapios/pagina/';
        $config['total_rows'] = $this->cardapios_model->count('cardapios');
        $config['per_page'] = 10;	
        
        $this->pagination->initialize($config);
        
	$this->data['results'] = $this->cardapios_model->get('cardapios','*','',$config['per_page'],$this->uri->segment(3));
        $this->data['titulo'] = "Lista de cardapios";
        $this->data['pagina'] = "cardapios/lista";
                
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
                'field' => 'cardapio',
                'label' => 'Cardapio',
                'rules' => 'required'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['cardapio'] = $this->input->post('cardapio');
            $data['ativo'] = $this->input->post('ativo');

            $this->load->model('cardapios_model');
            if ($this->cardapios_model->cadastrar($data)) {
                redirect('cardapios');
            } else {
                log_message('error', 'Erro no cadastro...');
            }
        }
    }
    
    function deletar($id) {
        $this->load->model('cardapios_model');
        if ($this->cardapios_model->deletar($id)) {
            redirect('cardapios/listar');
        } else {
            log_message('error', 'Erro ao deletar...');
        }
    }
    
    function editar($id)  {
        $this->load->library('breadcrumb');
        $this->breadcrumb->append_crumb('Home', '/');
        $this->breadcrumb->append_crumb('Cardapios', '/cardapios');
        $this->breadcrumb->append_crumb('Listar', '/listar');
        $data['titulo'] = "CRUD | Alteração de cardapios";
        $data['pagina'] = "cardapios/cardapios_edit";
        $this->load->model('cardapios_model');
        $data['dados_cardapio'] = $this->cardapios_model->editar($id);

        $this->load->view('template', $data);
    }
    
    function alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'cardapio',
                'label' => 'Cardapio',
                'rules' => 'required'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->input->post('id'));
        } else {
            $data['id_cardapio'] = $this->input->post('id');
            $data['cardapio'] = $this->input->post('cardapio');
            $data['ativo'] = $this->input->post('ativo');

            $this->load->model('cardapios_model');
            if ($this->cardapios_model->alterar($data)) {
                redirect('cardapios/listar');
            } else {
                log_message('error', 'Erro na alteração...');
            }
        }
    }
}

?>