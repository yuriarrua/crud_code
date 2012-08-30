<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?>   
<!-- abre o formulário de cadastro -->
    <?php echo form_open('clientes/cadastrar', 'id="form-clientes"'); ?>
    <label for="nome">Nome:</label><br/>
    <input type="text" name="nome" value="<?php echo set_value('nome'); ?>"/>
    <div class="error"><?php echo form_error('nome'); ?></div>
    <label for="endereco">Endereço:</label><br/>
    <input type="text" name="endereco" value="<?php echo set_value('endereco'); ?>"/>
    <div class="error"><?php echo form_error('endereco'); ?></div>
    <label for="horario">Horario:</label><br/>
    <input type="text" name="horario" value="<?php echo set_value('horario'); ?>"/>
    <div class="error"><?php echo form_error('horario'); ?></div>
    <label for="descricao">Descrição:</label><br/>
    <textarea name="descricao" id="descricao" rows="5" cols="40"><?php echo set_value('descricao'); ?></textarea>
    <div class="error"><?php echo form_error('descricao'); ?></div>
    <select name="select" id="select">
        <?php foreach($clientes as $cliente): ?>
            <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->nome; ?></option>
        <?php endforeach ?>
    </select>
   
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
    <!-- fecha o formulário de cadastro -->
    <br />
    <p> Clientes cadastrados: </p>
    <!-- inicio lista de registros -->
<ul>
    <?php foreach($clientes as $cliente): ?>
    <li>
        <span><?php echo $cliente->nome; ?></span>
        <span> - </span>
        <span><?php echo $cliente->endereco; ?></span>
        <span> - </span>
        <span><?php echo $cliente->descricao; ?></span>
        <span> | </span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/clientes/editar/' . $cliente->id; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/clientes/deletar/' . $cliente->id; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros -->
<?php } else { ?>
<div class="error">Você precisa estar logado para acessar esta área do site <br />
<a href="<?php echo base_url() . 'index.php/login/' ?>">Clique aqui para voltar</a>
</div>
<?php } ?>
