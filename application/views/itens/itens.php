<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?>   
<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript">
      //setInterval("my_function();",5000); 
    function my_function(){
       //alert('bobou');
    $('#refresh').load(location.href + ' .cat');
    }
    function add_categoria(){
        $('#add_cat').show();
    }
  </script>
<!-- abre o formulário de cadastro -->
    <?php echo form_open('itens/cadastrar', 'id="form-itens"'); ?>
    <input type="hidden" name="id_pizzaria" value="<?php echo $this->session->userdata('id_user'); ?>"/>
    <label for="item">Item:</label><br/>
    <input type="text" name="item" value="<?php echo set_value('item'); ?>"/>
    <div class="error"><?php echo form_error('item'); ?></div>
    <div class="cat" id="refresh">
    <label for="categoria">Categoria:</label><br/>
    <select name="categoria" id="select">
        <?php foreach($categorias as $categoria): ?>
            <option value="<?php echo $categoria->id_cat; ?>"><?php echo $categoria->categoria; ?></option>
        <?php endforeach ?>
    </select><a href="#" id="add_categoria" onclick="add_categoria()">Add Categoria</a><br />
    </div>
    <div style="display: none;" id="add_cat">
        <iframe src="<?php echo base_url() ?>index.php/itens/add" name="teste" width="200" marginwidth="0" height="80" marginheight="0" scrolling="no" frameborder="0"></iframe>
    </div>
    <label for="item">Preço(R$):</label><br/>
    <input type="text" name="preco" value="<?php echo set_value('preco'); ?>"/>
    <div class="error"><?php echo form_error('preco'); ?></div>
    <label for="item">Descrição:</label><br/>
    <textarea name="descricao" id="descricao" rows="5" cols="40"><?php echo set_value('descricao'); ?></textarea>
    <div class="error"><?php echo form_error('descricao'); ?></div>
    <br/><br/>
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
    <!-- fecha o formulário de cadastro -->

    <p> Itens cadastrados: </p>
    <!-- inicio lista de registros -->
<ul>
    <?php foreach($itens as $item): ?>
    <li>
        <span><?php echo $item->item; ?></span>
        <span> - </span>
        <span><?php echo $item->categoria; ?></span>
        <span> | </span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/itens/editar/' . $item->id_item; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/itens/deletar/' . $item->id_item; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros -->
<?php } else { ?>
<div class="error">Você precisa estar logado para acessar esta área do site <br />
<a href="<?php echo base_url() . 'index.php/login/' ?>">Clique aqui para voltar</a>
</div>
<?php } ?>