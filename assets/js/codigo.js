/**
 * Relação de functions e widgets jQuery
 */


			/** ATIVANDO O MODAL BOOTSTRAP **/
			$('#myModal').on('shown.bs.modal', function () {
			  $('#myInput').focus()
			})
			
			$(function () {
				
				$( "a#encaminhar" ).click(function() {
					$("div.encaminhamento").slideToggle("slow");
				});
				
			});
				
			/** ATIVANDO O MODAL BOOTSTRAP **/


			/**FUNÇÃO DE PESQUISA ASSINCRONO SETROES INTERNOS **/
			
				
			$(function(){
			  $(".inputDestino").autocomplete({
				minLength: 2,
			    source: "http://localhost/sisgestao/protocolo/get_externo" // path to the get_birds method
			  });
			});
			
			function limparDestinatario(){
				
				$(".inputIDDestino").val('');
		  		$(".inputDestino").val('');
		  		$(".inputDestino").focus();
				
			}
			
			function buscarDestinatario(){

			    busca = $(".inputDestino").val();
			    if(busca!=''){
			    	$.ajax({
			    		  url: "http://localhost/sisgestao/protocolo/externo_informacoes/"+busca,
			    		  type: "POST",
			    		  dataType: "json",
			    		  data: 'busca='+busca,
			    		  success: function(json){
			    			  
				    			if(json == 1){
				  					alert('Destinatário não cadastrado.');
				  					$(".inputDestino").val('');
				  					$(".inputIDDestino").val('');
				  					$(".inputDestino").focus();
				  					
				      		  	}else{
				      		  		$(".inputIDDestino").val(json.id_externo);

				      			  	if($(".inputIDOrigem").val() == $(".inputIDDestino").val()){
				      			  		
				      			  		alert("Remetente e o Destinatário são iguais, não é possível concluir o cadastro.");
				      			  		$(".inputIDDestino").val('');
				      			  		$(".inputDestino").val('');
				      			  		$(".inputDestino").focus();
				      			  	}

				      		  	}
			      		  	
			    		  }
			    		    
			    		});
			    	

			    }
			    else{
			        $(".inputDestino").val('');
			        $(".inputDestino").focus();
			        //window.alert("O Destinatário deve ser preenchido");
			    }

			}
			
			
			
			$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
			
			$(document).ready(function () {

				$("#CodigoRastreamento").hide();
				
				   $("input:radio[name=procedimento]").click(function () {  
				      if( $("#inputTipoRecebido").is(':checked') ){
				    	  	$("#CodigoRastreamento").hide();
				      } 
				      if( $("#inputTipoExpedido").is(':checked') ){
				    	  	$("#CodigoRastreamento").show();
				    	  	
				      }
				  
				   });

				 
				});
			
			$(function(){
				$("#datepicker").datepicker({
					dateFormat: 'dd/mm/yy',
				    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
				    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
				    nextText: 'Próximo',
				    prevText: 'Anterior'
				});
			})
			


