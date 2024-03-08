<?php 
namespace controller;

final class empreendimentoController
{
    public function index($par){
        \views\mainView::setParam(['imoveis'=>\models\homeModel::pegaImoveis()]);
        \views\mainView::render('empreendimentos.php');
    }
}
?>