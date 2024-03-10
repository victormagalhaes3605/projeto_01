$(function(){
    // arquivo pai do sistema.
    $('[name=preco_min],[name=preco_max]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

   setInterval(function(){
    sendRequest()
   },3000)

    function sendRequest(){
        $('form').ajaxSubmit({
            data:{'nome_imovel':$('input[name=texto-busca]').val()},
            success:function(data){
                $('.lista-imoveis .container').html(data)
            }
        })
    }
})