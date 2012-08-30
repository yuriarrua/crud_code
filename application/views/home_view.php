<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript">
    setInterval("check_changes();",5000); 
    
        function check_changes(){
            $.ajax({
                url: "home/check_changes",
                success: function(sucesso){
                    alert($conta);
                },
                error: function(){
                    //alert('não deu');
                }
            });
        }
        
        function verifica(){
            $.ajax({
                url: "itens/listar",
                success: function(sucesso){
                    //alert('deu');
                },
                error: function(){
                    alert('não deu');
                }
            });
        }    
    
  </script>
  
<p>Versão do MySql é: <?php echo $db; echo "conta ".$conta?></p>
        <?php echo "ID do usuario logado: ".$this->session->userdata('id_user'); ?>
