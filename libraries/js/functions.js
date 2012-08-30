
                jQuery(document).ready(function() {
                                jQuery('.clientes').mouseover(function() {
                                                jQuery('.clientes').attr("id","menu_selecionado");
						
						jQuery('#sub_cardapios').hide();
                                                jQuery('#sub_categorias').hide();
                                                jQuery('#sub_itens').hide();
                                                jQuery('#sub_clientes').show();
				});
						
				jQuery('.cardapios').mouseover(function() {
						jQuery('.cardapios').attr("id","menu_selecionado");
						
						jQuery('#sub_categorias').hide();
                                                jQuery('#sub_itens').hide();
                                                jQuery('#sub_clientes').hide();
                                                jQuery('#sub_cardapios').show();
				});
                                
                                jQuery('.categorias').mouseover(function() {
						jQuery('.categorias').attr("id","menu_selecionado");
						
                                                jQuery('#sub_itens').hide();
                                                jQuery('#sub_clientes').hide();
						jQuery('#sub_cardapios').hide();
                                                jQuery('#sub_categorias').show();
				});
                                
                                jQuery('.itens').mouseover(function() {
						jQuery('.itens').attr("id","menu_selecionado");
						
						jQuery('#sub_cardapios').hide();
                                                jQuery('#sub_categorias').hide();
                                                jQuery('#sub_clientes').hide();
                                                jQuery('#sub_itens').show();
				});
                 });