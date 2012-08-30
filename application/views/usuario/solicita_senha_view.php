<div id="content">
	<h3>Solicita&ccedil;&atilde;o de Nova Senha</h3>
    
    <p>Para solicitar uma nova senha, digite o e-mail cadastrado.<br>
    A nova senha ser&aacute; enviada para o e-mail informado.</p>
    
    <?php echo form_open('usuario/gera_senha');?>
    <p>E-mail: <input name="email" type="text" size="25"> <input name="submit" type="submit" value="OK"><span class="formError"><?php echo form_error('email')?></span><p>
    <?php echo form_close();?>

</div>