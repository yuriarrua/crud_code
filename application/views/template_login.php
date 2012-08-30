<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF8" />
    <title><?php echo $titulo; ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>libraries/css/estilo.css"/>
</head>
<body>
        <p>TOPO DA APLICAÇÃO<br /></p>
        <a title="Home" href="<?php echo base_url() ?>index.php/"> Home </a>
        <span> | </span>
        <a title="Cadastrar" href="<?php echo base_url() ?>index.php/clientes"> Cadastro de clientes </a>
        <span> | </span>
        <a title="Listar" href="<?php echo base_url() ?>index.php/clientes/listar"> Listar clientes </a>
        <hr /><br />
	<?php $this->load->view($pagina); ?>
	<br />
        <hr />
	<p>RODAPÉ DA APLICAÇÃO</p>
</body>
</html>