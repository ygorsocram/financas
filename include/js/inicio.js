$('#decrementa').on('click', function(){
		var data_inicio = altera_mes($('#data_inicio').val(),-1),
			data_fim = altera_mes($('#data_fim').val(),-1);

		$.ajax({
			url: host+'/inicio',
			method: 'POST',
			data:{
				data_inicio,
				data_fim
			}
		})
})

function altera_mes(data_entrada,funcao){
	var ano = data_entrada.substring(0,4),
		mes = (data_entrada.substring(5,7)-1) ,
		dia = data_entrada.substring(8,10),
		data_retorno = new Date(ano,mes,dia);

    data_retorno.setMonth( data_retorno.getMonth() + funcao);

    ano = data_retorno.substring(0,4);
	mes = (data_retorno.substring(5,7)-1);
	dia = data_retorno.substring(8,10);

	data_retorno = ano+'-'+mes+'-'+dia;

	alert(data_retorno);
}