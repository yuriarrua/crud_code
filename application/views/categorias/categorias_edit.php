        <!-- abre o formulário de edição -->
        <?php echo form_open('categorias/alterar', 'id="form-categorias"'); ?>
        <input type="hidden" name="id" value="<?php echo $dados_categorias[0]->id_cat; ?>"/>
        <label for="nome">Nome:</label><br/>
        <input type="text" name="categoria" value="<?php echo $dados_categorias[0]->categoria; ?>"/>
        <div class="error"><?php echo form_error('categoria'); ?></div>
               
        <input type="submit" name="alterar" value="Alterar" />
        <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
        <?php echo form_close(); ?>
        <!-- fecha o formulário de edição -->
