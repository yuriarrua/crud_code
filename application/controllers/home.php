<?php

    class home extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->output->enable_profiler(TRUE);
        }
        
        function index() {
            $data['titulo'] = "Pagina principal";
            $data['db'] = $this->db->version();
            $data['pagina'] = "home_view";
            $this->load->view('template', $data);
            
        }
        
        function check_changes(){
            $this->load->model('itens_model');
            $conta = $this->itens_model->contar();
            return $conta;
        }
    }

?>
