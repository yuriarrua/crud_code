<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?>   
<!-- abre o formulário de cadastro -->
    <?php echo form_open('categorias/cadastrar', 'id="form-categorias"'); ?>
    <label for="categoria">Categoria:</label><br/>
    <input type="text" name="categoria" value="<?php echo set_value('categoria'); ?>"/>
    <div class="error"><?php echo form_error('categoria'); ?></div>
       
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
    <!-- fecha o formulário de cadastro -->
    <br />
    <p> Categorias cadastradas: </p>
    <!-- inicio lista de registros -->
<ul>
    <?php foreach($categorias as $categoria): ?>
    <li>
        <span><?php echo $categoria->categoria; ?></span>
        <span> | </span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/categorias/editar/' . $categoria->id_cat; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/categorias/deletar/' . $categoria->id_cat; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros -->
<?php } else { ?>
<div class="error">Você precisa estar logado para acessar esta área do site <br />
<a href="<?php echo base_url() . 'index.php/login/' ?>">Clique aqui para voltar</a>
</div>
<?php } ?>
