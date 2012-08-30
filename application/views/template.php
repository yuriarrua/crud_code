<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF8" />
    <title><?php echo $titulo; ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>libraries/css/estilo.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>libraries/js/prototype.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>libraries/js/functions.js"></script>
</head>
<body>
        <p>TOPO DA APLICAÇÃO<br /></p>
        <?php
            //Verifica se o usuario esta logado
            if($this->session->userdata('is_logged_in')){
        ?> 
        <a class="home" title="Home" href="<?php echo base_url() ?>index.php/home"> Home </a>
        <span> | </span>
<!--        <a class="clientes" title="Clientes" href="<?php echo base_url() ?>index.php/clientes"> Clientes </a>
        <span> | </span>-->
        <a class="categorias" title="categorias" href="<?php echo base_url() ?>index.php/categorias"> Categorias </a>
        <span> | </span>
        <a class="cardapios" title="cardapios" href="<?php echo base_url() ?>index.php/cardapios"> Cardapios </a>
        <span> | </span>
        <a class="itens" title="itens" href="<?php echo base_url() ?>index.php/itens"> Itens </a>
        <span> | </span>
        <a title="Logout" href="<?php echo base_url() ?>index.php/login/logout"> Logout </a>
        <?php } ?>
        <hr />
        <div style="display: none;" id="sub_clientes">
            <a title="Cadastrar" href="<?php echo base_url() ?>index.php/clientes"> Cadastro de clientes </a>
            <span> | </span>
            <a title="Listar" href="<?php echo base_url() ?>index.php/clientes/listar"> Listar clientes </a>
        </div>
        <div style="display: none;" id="sub_cardapios">
            <a title="Cadastrar" href="<?php echo base_url() ?>index.php/cardapios"> Cadastro de cardapios </a>
            <span> | </span>
            <a title="Listar" href="<?php echo base_url() ?>index.php/cardapios/listar"> Listar cardapios </a>
        </div>
        <div style="display: none;" id="sub_categorias">
             <a title="Cadastrar" href="<?php echo base_url() ?>index.php/categorias"> Cadastro de categorias </a>
            <span> | </span>
            <a title="Listar" href="<?php echo base_url() ?>index.php/categorias/listar"> Listar categorias </a>
        </div>
        <div style="display: none;" id="sub_itens">
            <a title="Cadastrar" href="<?php echo base_url() ?>index.php/itens"> Cadastro de itens </a>
            <span> | </span>
            <a title="Listar" href="<?php echo base_url() ?>index.php/itens/listar"> Listar itens </a>
        </div>
        <br />
	<?php $this->load->view($pagina); ?>
	<br />
        <hr />
	<p>RODAPÉ DA APLICAÇÃO</p>
        <p>Desenvolvido por Yuri Arrua</p>
</body>
</html>