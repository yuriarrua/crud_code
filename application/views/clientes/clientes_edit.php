        <!-- abre o formulário de edição -->
        <?php echo form_open('clientes/alterar', 'id="form-clientes"'); ?>
        <input type="hidden" name="id" value="<?php echo $dados_cliente[0]->id; ?>"/>
        <label for="nome">Nome:</label><br/>
        <input type="text" name="nome" value="<?php echo $dados_cliente[0]->nome; ?>"/>
        <div class="error"><?php echo form_error('nome'); ?></div>
        <label for="email">Endereço:</label><br/>
        <input type="text" name="endereco" value="<?php echo $dados_cliente[0]->endereco; ?>"/>
        <div class="error"><?php echo form_error('endereco'); ?></div>
        <label for="horario">Horario:</label><br/>
        <input type="text" name="horario" value="<?php echo $dados_cliente[0]->horario; ?>"/>
        <div class="error"><?php echo form_error('horario'); ?></div>
        <label for="email">Descrição:</label><br/>
        <input type="text" name="descricao" value="<?php echo $dados_cliente[0]->descricao; ?>"/>
        <div class="error"><?php echo form_error('descricao'); ?></div>
        
        <input type="submit" name="alterar" value="Alterar" />
        <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
        <?php echo form_close(); ?>
        <!-- fecha o formulário de edição -->
