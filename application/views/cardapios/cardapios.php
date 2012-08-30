<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?>   
<!-- abre o formulário de cadastro -->
    <?php echo form_open('cardapios/cadastrar', 'id="form-cardapios"'); ?>
    <label for="cardapio">Cardapio:</label><br/>
    <input type="text" name="cardapio" value="<?php echo set_value('cardapio'); ?>"/>
    <div class="error"><?php echo form_error('cardapio'); ?></div><br/>
    <label for="cardapio">Cardapio ativo?</label><br/>
    <input name="ativo" type="radio" id="ativo" value="1" checked="checked" />Sim 
    <input type="radio" name="ativo" id="ativo" value="0" />Não <br/><br/>  
    <input type="submit" name="cadastrar" value="Cadastrar" />
    <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
    <?php echo form_close(); ?>
    <!-- fecha o formulário de cadastro -->
    <br />
    <p> Cardapios cadastrados: </p>
    <!-- inicio lista de registros -->
<ul>
    <?php foreach($cardapios as $cardapio): ?>
    <li>
        <span><?php echo $cardapio->cardapio; ?></span>
        <span> - </span>
        <span><?php if($cardapio->ativo == 1){ echo "Ativo"; }else{ echo "Inativo"; } ?></span>
        <span> | </span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/cardapios/editar/' . $cardapio->id_cardapio; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/cardapios/deletar/' . $cardapio->id_cardapio; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros -->
<?php } else { ?>
<div class="error">Você precisa estar logado para acessar esta área do site <br />
<a href="<?php echo base_url() . 'index.php/login/' ?>">Clique aqui para voltar</a>
</div>
<?php } ?>
