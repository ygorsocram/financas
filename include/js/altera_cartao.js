var host = window.location.origin;
monta_faturas();

$('#cartao').change(function(){
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