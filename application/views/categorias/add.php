<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
        window.parent.my_function();
 });
</script>
<!-- abre o formulário de cadastro -->
    <?php echo form_open('itens/cadastrar_categoria', 'id="form-categorias"'); ?>
    <label for="categoria">Categoria:</label><br/>
    <input type="text" name="categoria" value="<?php echo set_value('categoria'); ?>"/>
    <div class="error"><?php echo form_error('categoria'); ?></div>
       
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
<!-- fecha o formulário de cadastro -->