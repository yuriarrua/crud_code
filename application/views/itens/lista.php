<?php
//Verifica se o usuario esta logado
if($this->session->userdata('is_logged_in')){
?> 
<!-- inicio lista de registros -->
<ul>
    <?php foreach($results as $item): ?>
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
<!-- fim lista de registros-->
<!-- Inicio da paginação -->
<div id="paginacao">
    <?php
        echo $this->pagination->create_links();
    ?>
</div>
<!-- fim da paginação -->
<?php } ?>