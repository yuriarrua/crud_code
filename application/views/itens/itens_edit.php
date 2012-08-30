        <!-- abre o formulário de edição -->
        <?php echo form_open('itens/alterar', 'id="form-itens"'); ?>
        <input type="hidden" name="id" value="<?php echo $dados_itens[0]->id_item; ?>"/>
        <label for="item">Item:</label><br/>
        <input type="text" name="item" value="<?php echo $dados_itens[0]->item; ?>"/>
        <div class="error"><?php echo form_error('item'); ?></div>
        <label for="categoria">Categoria:</label><br/>
        <select name="categoria" id="select">
            <?php foreach($categorias as $categoria): ?>
                <option <?php if($dados_itens[0]->id_categoria == $categoria->id_cat){ echo "selected"; } ?> value="<?php echo $categoria->id_cat; ?>"><?php echo $categoria->categoria; ?></option>
            <?php endforeach ?>
        </select><br />
        <label for="item">Preço:</label><br/>
        <input type="text" name="preco" value="<?php echo $dados_itens[0]->preco; ?>"/>
        <div class="error"><?php echo form_error('preco'); ?></div>
        <label for="email">Descrição:</label><br/>
        <textarea name="descricao" id="descricao" rows="5" cols="40"><?php echo $dados_itens[0]->descricao; ?></textarea>
        <div class="error"><?php echo form_error('descricao'); ?></div>
        <br/><br/>
                
        <input type="submit" name="alterar" value="Alterar" />
        <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
        <?php echo form_close(); ?>
        <!-- fecha o formulário de edição -->