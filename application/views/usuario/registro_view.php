<div id="content">
	<h3>Registro de Anunciante</h3>
    <?php echo form_open('usuario/checa_registro');?>
	<table>
    	<tr><td>Seu Nome Completo</td><td><input name="nome" type="text" size="25"><span class="formError"><?php echo form_error('nome')?></span></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td>Seu E-mail</td><td><input name="email" type="text" size="25"><span class="formError"><?php echo form_error('email')?></span></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td>Senha</td><td><input name="senha" type="password"><span class="formError"><?php echo form_error('senha')?></span></td></tr>
        <tr><td>Confirmar Senha</td><td><input name="senha1" type="password"><span class="formError"><?php echo form_error('senha1')?></span></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><th colspan="2"><input name="submit" type="submit" value="Cadastrar"></th></tr>
	</table>
    <?php echo form_close();?>

</div>