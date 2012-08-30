<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class pizzarias extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
        //Carregar o debug
        $this->output->enable_profiler(TRUE);
    }
    
    function index(){
        $data['titulo'] = "Testando o CRUD";
        $data['pagina'] = "pizzarias/pizzarias";
        $this->load->model('pizzarias_model');
        $data['pizzarias'] = $this->pizzarias_model->listar();
        
        $this->load->view('template', $data);
    }
    
    function pagina(){
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('pizzarias_model');
        
        $config['base_url'] = base_url().'index.php/pizzarias/pagina/';
        $config['total_rows'] = $this->pizzarias_model->count('pizzarias');
        $config['per_page'] = 5;	
        
        $this->pagination->initialize($config);
        
	$this->data['results'] = $this->pizzarias_model->get('pizzarias','id_pizzaria,fantasia,endereco,horario,descricao','',$config['per_page'],$this->uri->segment(3));
        $this->data['titulo'] = "Lista de pizzarias";
        $this->data['pagina'] = "pizzarias/lista";
                
	$this->load->view('template', $this->data);
    }
    
    function listar(){
        $this->pagina();
    }
    
    function upload($dados){
        //Configurações necessárias para fazer upload do arquivo

        $this->arquivo=$_FILES['userfile'];
        $this->arquivo_nome=$this->arquivo["name"];
        $this->arquivo_temporario=$this->arquivo["tmp_name"];
        // upload e registro de pasta
        $this->arquivo_diretorio = './logos/'.$this->arquivo_nome;
        // Upload e alocação de arquivo
        $this->mover_arquivo= move_uploaded_file($this->arquivo_temporario, $this->arquivo_diretorio);
        //Carregando a lib com as configurações feitas

        if( ! $this->mover_arquivo){
            echo "<script>alert('Ocorreu um erro ao cadastrar a imagem no servidor')</script>";
            echo "<script>history.back();</script>";
        }
        else
        {
           if( $this->pizzarias_model->cadastrar($dados)){
               redirect('pizzarias');
           }
        }
    }
    
    function upload_edit($data){
        //Configurações necessárias para fazer upload do arquivo
        $base = base_url();
        $this->arquivo=$_FILES['userfile'];
        $this->arquivo_nome=$this->arquivo["name"];
        $this->arquivo_temporario=$this->arquivo["tmp_name"];
        // upload e registro de pasta
        $this->arquivo_diretorio = './logos/'.$this->arquivo_nome;
        // Upload e alocação de arquivo
        $this->mover_arquivo= move_uploaded_file($this->arquivo_temporario, $this->arquivo_diretorio);
        //Carregando a lib com as configurações feitas

        if( ! $this->mover_arquivo){
            echo "<script>alert('Ocorreu um erro ao cadastrar a imagem no servidor')</script>";
            echo "<script>history.back();</script>";
        }
        else
        {
           if ($this->pizzarias_model->alterar_com_imagem($data)) {
               unlink("./logos/".$this->input->post('imagem'));
               redirect('pizzarias/listar');
           }
        }
    }
    
    function cadastrar(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $validations = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'fantasia',
                'label' => 'Fantasia',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'endereco',
                'label' => 'Endereço',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'numero',
                'label' => 'Numero',
                'rules' => 'required'
            ),
            array(
                'field' => 'cep',
                'label' => 'CEP',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required'
            ),
            array(
                'field' => 'cpfcnpj',
                'label' => 'CPF/CNPJ',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'telefone1',
                'label' => 'Telefone',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => 'horario',
                'label' => 'Horario de funcionamento',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'senha',
                'label' => 'Senha',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'senha2',
                'label' => 'Confirme a senha',
                'rules' => 'matches[senha]|required'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
           echo "<script>history.back();</script>";
        } else {
            $dados['nome'] = $this->input->post('nome');
            $dados['fantasia'] = $this->input->post('fantasia');
            $dados['endereco'] = $this->input->post('endereco');
            $dados['numero'] = $this->input->post('numero');
            $dados['bairro'] = $this->input->post('bairro');
            $dados['cep'] = $this->input->post('cep');
            $dados['cidade'] = $this->input->post('cidade');
            $dados['estado'] = $this->input->post('estado');
            $dados['cpfcnpj'] = $this->input->post('cpfcnpj');
            $dados['telefone1'] = $this->input->post('telefone1');
            $dados['telefone2'] = $this->input->post('telefone2');
            $dados['site'] = $this->input->post('site');
            $dados['email'] = $this->input->post('email');
            $dados['senha'] = MD5($this->input->post('senha'));
            $dados['horario'] = $this->input->post('horario');
            $dados['descricao'] = $this->input->post('descricao');
            $dados['logo'] = $_FILES['userfile']['name'];

            $this->load->model('pizzarias_model');
            if ($_FILES['userfile']['name']!= null) {
                if ($this->upload($dados)) {
                    //redirect('pizzarias');
                } else {
                    log_message('error', 'Erro no cadastro...');
                }
            }else{
                if($this->pizzarias_model->cadastrar($dados)){
                    redirect('pizzarias');
                }
            }
        }
    }
    
    function deletar($id) {
        $this->load->model('pizzarias_model');
        if ($this->pizzarias_model->deletar($id)) {
            redirect('pizzarias/listar');
        } else {
            log_message('error', 'Erro ao deletar...');
        }
    }
    
    function editar($id)  {
        $data['titulo'] = "CRUD | Alteração de pizzarias";
        $data['pagina'] = "pizzarias/pizzarias_edit";
        $this->load->model('pizzarias_model');
        $data['dados_pizzaria'] = $this->pizzarias_model->editar($id);

        $this->load->view('template', $data);
    }
    
    function alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
         $validations = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'fantasia',
                'label' => 'Fantasia',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'endereco',
                'label' => 'Endereço',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'numero',
                'label' => 'Numero',
                'rules' => 'required'
            ),
            array(
                'field' => 'cep',
                'label' => 'CEP',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required'
            ),
            array(
                'field' => 'cpfcnpj',
                'label' => 'CPF/CNPJ',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'telefone1',
                'label' => 'Telefone',
                'rules' => 'required|min_length[8]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => 'horario',
                'label' => 'Horario de funcionamento',
                'rules' => 'required|min_length[4]'
            ),
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
        );
        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            $this->editar($this->input->post('id'));
        } else {
            $data['id_pizzaria'] = $this->input->post('id');
            $data['nome'] = $this->input->post('nome');
            $data['fantasia'] = $this->input->post('fantasia');
            $data['endereco'] = $this->input->post('endereco');
            $data['numero'] = $this->input->post('numero');
            $data['bairro'] = $this->input->post('bairro');
            $data['cep'] = $this->input->post('cep');
            $data['cidade'] = $this->input->post('cidade');
            $data['estado'] = $this->input->post('estado');
            $data['cpfcnpj'] = $this->input->post('cpfcnpj');
            $data['telefone1'] = $this->input->post('telefone1');
            $data['telefone2'] = $this->input->post('telefone2');
            $data['site'] = $this->input->post('site');
            $data['email'] = $this->input->post('email');
            $data['horario'] = $this->input->post('horario');
            $data['descricao'] = $this->input->post('descricao');
         

            $this->load->model('pizzarias_model');
            if ($_FILES['userfile']['name']!= null) {
                $data['logo'] = $_FILES['userfile']['name'];
                if ($this->upload_edit($data)) {
                    redirect('pizzarias/listar');
                } else {
                    log_message('error', 'Erro no cadastro...');
                }
            }else{
               if ($this->pizzarias_model->alterar($data)) {
                    redirect('pizzarias/listar');
                }
            }
        }
    }
}

?>