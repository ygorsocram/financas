var host = window.location.origin+'/financas';
var id_fatura_antiga_valor = $('#fatura').val();
var id_cartao_antigo_valor = $('#cartao').val();

$('#cartao').change(function(){
    document.getElementById("id_cartao_antigo").value = id_cartao_antigo_valor;
    monta_faturas();
});

function monta_faturas(){
    $('#fatura').html('');
    $.ajax({
        url: host + '/cartao/retorna_faturas',
        method:"POST",
        dataType: "json",
        data:{cartao: $('#cartao').val()},
        success:function(data){
            $.each(data, function(i, item){
                    var linha = '<option value="'+ item.id_fatura+'">' + item.nome+ '</option>';
                    $('#fatura').append(linha);
            });
        }
    });
}

$('#fatura').change(function(){
    document.getElementById("id_fatura_antiga").value = id_fatura_antiga_valor;
});