<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?>   
<!-- abre o formulário de cadastro -->
    <?php echo form_open_multipart('pizzarias/cadastrar'); ?>
        <label for="nome">Nome:</label><br/>
        <input type="text" name="nome" value="<?php echo set_value('nome'); ?>"/>
        <div class="error"><?php echo form_error('nome'); ?></div>
         <label for="fantasia">Fantasia:</label><br/>
        <input type="text" name="fantasia" value="<?php echo set_value('fantasia'); ?>"/>
        <div class="error"><?php echo form_error('fantasia'); ?></div>
        <label for="endereco">Endereço:</label><br/>
        <input type="text" name="endereco" value="<?php echo set_value('endereco'); ?>"/>
        <div class="error"><?php echo form_error('endereco'); ?></div>
         <label for="numero">Numero:</label><br/>
        <input type="text" name="numero" value="<?php echo set_value('numero'); ?>"/>
        <div class="error"><?php echo form_error('numero'); ?></div>
         <label for="bairro">Bairro:</label><br/>
        <input type="text" name="bairro" value="<?php echo set_value('bairro'); ?>"/>
        <div class="error"><?php echo form_error('bairro'); ?></div>
         <label for="cep">CEP:</label><br/>
        <input type="text" name="cep" value="<?php echo set_value('cep'); ?>"/>
        <div class="error"><?php echo form_error('cep'); ?></div>
         <label for="cidade">Cidade:</label><br/>
        <input type="text" name="cidade" value="<?php echo set_value('cidade'); ?>"/>
        <div class="error"><?php echo form_error('cidade'); ?></div>
         <label for="estado">Estado:</label><br/>
        <input type="text" name="estado" value="<?php echo set_value('estado'); ?>"/>
        <div class="error"><?php echo form_error('estado'); ?></div>
         <label for="cpfcnpj">CPF/CNPJ:</label><br/>
        <input type="text" name="cpfcnpj" value="<?php echo set_value('cpfcnpj'); ?>"/>
        <div class="error"><?php echo form_error('cpfcnpj'); ?></div>
         <label for="telefone1">Telefone:</label><br/>
        <input type="text" name="telefone1" value="<?php echo set_value('telefone1'); ?>"/>
        <div class="error"><?php echo form_error('telefone1'); ?></div>
         <label for="telefone2">Telefone2:</label><br/>
        <input type="text" name="telefone2" value="<?php echo set_value('telefone2'); ?>"/><br/>
         <label for="site">Site:</label><br/>
        <input type="text" name="site" value="<?php echo set_value('site'); ?>"/>
        <div class="error"><?php echo form_error('site'); ?></div>
         <label for="email">Email:</label><br/>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>"/>
        <div class="error"><?php echo form_error('email'); ?></div>
        <label for="senha">Senha:</label><br/>
        <input type="password" name="senha" value="<?php echo set_value('senha'); ?>"/>
        <div class="error"><?php echo form_error('senha'); ?></div>
        <label for="senha2">Confirme a senha:</label><br/>
        <input type="password" name="senha2" value="<?php echo set_value('senha2'); ?>"/>
        <div class="error"><?php echo form_error('senha2'); ?></div>
        <label for="horario">Horario de funcionamento:</label><br/>
        <input type="text" name="horario" value="<?php echo set_value('horario'); ?>"/>
        <div class="error"><?php echo form_error('horario'); ?></div>
        <label for="descricao">Descrição:</label><br/>
        <textarea name="descricao" id="descricao" rows="5" cols="40"><?php echo set_value('descricao'); ?></textarea>
        <div class="error"><?php echo form_error('descricao'); ?></div>
         <label for="logo">Logo:</label><br/>
        <input type="file" name="userfile" id="userfile" size="20" />
        <div class="error"><?php echo form_error('logo'); ?></div>
   
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
    <!-- fecha o formulário de cadastro -->
    <br />
    <p> pizzarias cadastrados: </p>
    <!-- inicio lista de registros -->
<ul>
    <?php foreach($pizzarias as $pizzaria): ?>
    <li>
        <span><?php echo $pizzaria->nome; ?></span>
        <span> - </span>
        <span><?php echo $pizzaria->endereco; ?></span>
        <span> - </span>
        <span><?php echo $pizzaria->descricao; ?></span>
        <span> | </span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/pizzarias/editar/' . $pizzaria->id_pizzaria; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/pizzarias/deletar/' . $pizzaria->id_pizzaria; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros -->
<?php } else { ?>
<div class="error">Você precisa estar logado para acessar esta área do site <br />
<a href="<?php echo base_url() . 'index.php/login/' ?>">Clique aqui para voltar</a>
</div>
<?php } ?>
