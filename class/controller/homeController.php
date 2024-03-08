<?php 
namespace controller;

final class homeController
{
    public function index(){
        \views\mainView::setParam(['imoveis'=>\models\homeModel::pegaImoveis()]);
        \views\mainView::render('home.php');
    }
}
?>