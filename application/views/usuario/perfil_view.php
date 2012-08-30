<div id="content">

<?php
foreach($user as $usuario){
?>
<table>
<tr><td>Nome:</td><td><?php echo $usuario->nm_nome;?></td></tr>
<tr><td>E-mail</td><td><?php echo $usuario->hl_email;?></td></tr>
<?php
}
foreach($detalhe as $det){
?>
<tr><td>Foto:</td><td><img src="<?php echo $det->hl_imagem;?>"></td></tr>
<tr><td>Twitter:</td><td><?php echo $det->hl_twitter;?></td></tr>
<tr><td>Facebook:</td><td><?php echo $det->hl_facebook;?></td></tr>
<tr><td>LinkedIn:</td><td><?php echo $det->hl_linkedin;?></td></tr>
<tr><td>Site Pessoal:</td><td><?php echo $det->hl_site_pessoal;?></td></tr>
<?php
}
?>

</div>