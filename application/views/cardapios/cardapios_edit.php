        <!-- abre o formulário de edição -->
        <?php 
        echo $this->breadcrumb->output();
        echo form_open('cardapios/alterar', 'id="form-cardapios"'); ?>
        <input type="hidden" name="id" value="<?php echo $dados_cardapio[0]->id_cardapio; ?>"/>
        <label for="nome">Nome:</label><br/>
        <input type="text" name="cardapio" value="<?php echo $dados_cardapio[0]->cardapio; ?>"/>
        <div class="error"><?php echo form_error('cardapio'); ?></div><br/>
        <label for="email">Ativo:</label><br/> 
        <input name="ativo" type="radio" id="ativo" value="1" <?php if($dados_cardapio[0]->ativo == 1){ ?> checked="checked" <?php } ?>/>Sim 
        <input type="radio" name="ativo" id="ativo" value="0" <?php if($dados_cardapio[0]->ativo == 0){ ?> checked="checked" <?php } ?>/>Não <br/><br/>  
        
        <input type="submit" name="alterar" value="Alterar" />
        <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
        <?php echo form_close(); ?>
        <!-- fecha o formulário de edição -->
