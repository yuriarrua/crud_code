        <!-- abre o formulário de edição -->
        <?php echo form_open_multipart('pizzarias/alterar', 'id="form-pizzarias"'); ?>
        <input type="hidden" name="id" value="<?php echo $dados_pizzaria[0]->id_pizzaria; ?>"/>
        <input type="hidden" name="imagem" value="<?php echo $dados_pizzaria[0]->logo; ?>"/>
        <label for="nome">Nome:</label><br/>
        <input type="text" name="nome" value="<?php echo $dados_pizzaria[0]->nome; ?>"/>
        <div class="error"><?php echo form_error('nome'); ?></div>
         <label for="fantasia">Fantasia:</label><br/>
        <input type="text" name="fantasia" value="<?php echo $dados_pizzaria[0]->fantasia; ?>"/>
        <div class="error"><?php echo form_error('fantasia'); ?></div>
        <label for="endereco">Endereço:</label><br/>
        <input type="text" name="endereco" value="<?php echo $dados_pizzaria[0]->endereco; ?>"/>
        <div class="error"><?php echo form_error('endereco'); ?></div>
         <label for="numero">Numero:</label><br/>
        <input type="text" name="numero" value="<?php echo $dados_pizzaria[0]->numero; ?>"/>
        <div class="error"><?php echo form_error('numero'); ?></div>
         <label for="bairro">Bairro:</label><br/>
        <input type="text" name="bairro" value="<?php echo $dados_pizzaria[0]->bairro; ?>"/>
        <div class="error"><?php echo form_error('bairro'); ?></div>
         <label for="cep">CEP:</label><br/>
        <input type="text" name="cep" value="<?php echo $dados_pizzaria[0]->cep; ?>"/>
        <div class="error"><?php echo form_error('cep'); ?></div>
         <label for="cidade">Cidade:</label><br/>
        <input type="text" name="cidade" value="<?php echo $dados_pizzaria[0]->cidade; ?>"/>
        <div class="error"><?php echo form_error('cidade'); ?></div>
         <label for="estado">Estado:</label><br/>
        <input type="text" name="estado" value="<?php echo $dados_pizzaria[0]->estado; ?>"/>
        <div class="error"><?php echo form_error('estado'); ?></div>
         <label for="cpfcnpj">CPF/CNPJ:</label><br/>
        <input type="text" name="cpfcnpj" value="<?php echo $dados_pizzaria[0]->cpfcnpj; ?>"/>
        <div class="error"><?php echo form_error('cpfcnpj'); ?></div>
         <label for="telefone1">Telefone:</label><br/>
        <input type="text" name="telefone1" value="<?php echo $dados_pizzaria[0]->telefone1; ?>"/>
        <div class="error"><?php echo form_error('telefone1'); ?></div>
         <label for="telefone2">Telefone2:</label><br/>
        <input type="text" name="telefone2" value="<?php echo $dados_pizzaria[0]->telefone2; ?>"/>
        <div class="error"><?php echo form_error('telefone2'); ?></div>
         <label for="site">Site:</label><br/>
        <input type="text" name="site" value="<?php echo $dados_pizzaria[0]->site; ?>"/>
        <div class="error"><?php echo form_error('site'); ?></div>
         <label for="email">Email:</label><br/>
        <input type="text" name="email" value="<?php echo $dados_pizzaria[0]->email; ?>"/>
        <div class="error"><?php echo form_error('email'); ?></div>
        <label for="horario">Horario:</label><br/>
        <input type="text" name="horario" value="<?php echo $dados_pizzaria[0]->horario; ?>"/>
        <div class="error"><?php echo form_error('horario'); ?></div>
         <label for="horario">Descrição:</label><br/>
        <textarea name="descricao" id="descricao" rows="5" cols="40"><?php echo $dados_pizzaria[0]->descricao; ?></textarea>
        <div class="error"><?php echo form_error('descricao'); ?></div>
         <label for="logo">Logo:</label><br/>
        <input type="file" name="userfile" id="userfile" size="20" />
        <div class="error"><?php echo form_error('logo'); ?></div>
        
        <input type="submit" name="alterar" value="Alterar" />
        <input type="button" id="botaoCancelar" value="Cancelar" onclick="history.go(-1)" />
        <?php echo form_close(); ?>
        <!-- fecha o formulário de edição -->