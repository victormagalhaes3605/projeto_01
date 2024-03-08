$(function(){
    // arquivo pai do sistema.
    $('[name=preco_min],[name=preco_max]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
})