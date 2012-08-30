<div id="content">
<?php echo form_open('login/valida');?>
<table>
<tr><td colspan="2"><strong>Acessar sua Conta</strong></td></tr>
<tr><td>E-mail:</td><td><input name="email" type="text" /></td></tr>
<tr><td>Senha:</td><td><input name="senha" type="password" /></td></tr>
<tr><th colspan="2"><input name="submit" type="submit" value="OK" /></th></tr>
<tr><td colspan="2"><a href="<?php echo site_url("login/solicita_senha");?>">Esqueceu sua senha?</a></td></tr>
</table>

<?php
if($msg){
?><div class="error">E-mail ou senha incorreto.</div><?php
}?>
<?php echo form_close();?>
</div>