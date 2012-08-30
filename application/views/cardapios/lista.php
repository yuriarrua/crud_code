<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
    echo $this->breadcrumb->output();
?> 
<!-- inicio lista de registros -->

<ul>
    <?php
    foreach($results as $cardapio): ?>
    <li>
        <span><?php echo $cardapio->cardapio; ?></span>
        <span> - </span>
        <span><?php if($cardapio->ativo == 1){ echo "Ativo"; }else{ echo "Inativo"; } ?></span>
        <a title="Editar" href="<?php echo base_url() . 'index.php/cardapios/editar/' . $cardapio->id_cardapio; ?>"><img src="<?php echo base_url() ?>libraries/img/edit.png" border="0" /></a>
        <span> - </span>
        <a title="Deletar" href="<?php echo base_url() . 'index.php/cardapios/deletar/' . $cardapio->id_cardapio; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"><img src="<?php echo base_url() ?>libraries/img/delete.png" border="0" /></a>
    </li>
    <?php endforeach ?>
</ul>
<!-- fim lista de registros-->
<!-- Inicio da paginação -->
<div id="paginacao">
    <?php
        echo $this->pagination->create_links();
    ?>
</div>
<!-- fim da paginação -->
<?php } ?>