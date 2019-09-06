// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "registrosMuestras.php";
var contador = 1;
//var folio = document.getElementById('folio').value;

$( document ).ready(function() {

   // se genera el paginador
   paginador = $(".pagination");
	// cantidad de items por pagina
	var items = 20, numeros =4;
	// inicia el paginador
	init_paginator(paginador,items,numeros);
	// se envia la peticion ajax que se realizara como callback
	set_callback(get_data_callback);
	cargaPagina(0);
});

function get_data_callback(){
	$.ajax({
		data:{
		limit: itemsPorPagina,
		offset: desde,
		},
		type:"POST",
		url:url_listar_usuario
	}).done(function(data,textStatus,jqXHR){
		// obtiene la clave lista del json data
		var lista = data.lista;
		$("#table").html("");

		// si es necesario actualiza la cantidad de paginas del paginador
		if(pagina==0){
			creaPaginador(data.cantidad);
		}
		// genera el cuerpo de la tabla
		$.each(lista, function(ind, elem){
      //alert(elem.idVendedor);
      if(elem.idCliente==0 && elem.idVendedor>0){
        $('<tr>'+
          '<td id="folio-'+contador+'">'+elem.folio+'</td>'+
          '<td>'+elem.fecha+'</td>'+
          '<td>'+elem.idVendedor+'</td>'+
          '<td>'+elem.nombreVendedor+'</td>'+
          '<td>'+elem.nombreDocumentador+' '+elem.apellidoDocumentador+'</td>'+
          '<td>'+formatNumber.new(elem.total, "$")+'</td>'+
          '<td><input type="button" class="btn btn-info btn-sm folio" value="Ver" id="ver-'+contador+'" /></td>'+
        '</tr>').appendTo($("#table"));
      }
      else{
        $('<tr>'+
          '<td id="folio-'+contador+'">'+elem.folio+'</td>'+
          '<td>'+elem.fecha+'</td>'+
          '<td>'+elem.idCliente+'</td>'+
          '<td>'+elem.nombreCliente+'</td>'+
          '<td>'+elem.nombreDocumentador+' '+elem.apellidoDocumentador+'</td>'+
          '<td>'+formatNumber.new(elem.total, "$")+'</td>'+
          '<td><input type="button" class="btn btn-info btn-sm folio" value="Ver" id="ver-'+contador+'" /></td>'+
        '</tr>').appendTo($("#table"));
      }
      //En la última vuelta del ciclo se construye la función que nos enviará a imprimir la muestra
      if(lista.length==contador){
        $(".folio").click(function(){
          var indice = $(this).attr("id");
          indice = indice.split("-");
          indice = indice[1];
          var folio = $("#folio-"+indice).text();
          setTimeout("location.href='impresion.php?folio="+folio+"'");
        });
      }
      contador++;

		});

	}).fail(function(jqXHR,textStatus,textError){
    console.log(textError);
		//alert("Error al realizar la peticion dame".textError);
	});

}
