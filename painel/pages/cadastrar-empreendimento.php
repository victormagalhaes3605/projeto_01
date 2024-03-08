<div class="box-content">

    <h2><i class="fa fa-pencil"></i> Cadastrar Empreendimento</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
                $preco = $_POST['preco'];
                $imagem = $_FILES['imagem'];

                //Imagem obrigatoria
                if($_FILES['imagem']['name'] == ''){
                    Painel::alert('erro','Você precisa selecionar uma imagem.');
                }else{
                    //imagem é valida ?
                    if(Painel::imagemValida($imagem) == false ){
                        Painel::alert('erro','Ops. Imagem invalida!');
                    }else{
                        //realizar cadastro e upload.
                        $idImagem = Painel::uploadFiles($imagem);
                        $slug = Painel::generateSlug($nome);
                        $sql = Msql::conectar()->prepare("INSERT INTO `tb_admin.empreendimentos` VALUES (null,?,?,?,?,?,?)");
                        $sql->execute(array($nome,$tipo,$preco,$idImagem,$slug,0));
                        $lastId = Msql::conectar()->lastInsertId();
                        Msql::conectar()->exec("UPDATE `tb_admin.empreendimentos`SET order_id = $lastId WHERE id = $lastId");
                        Painel::alert('sucesso','cadastro do empreendimento foi feito com sucesso!');
                    }
                }  

            }
        ?>

        <div class="form-group">
            <label for="">Nome</label>
            <input type="text" name="nome">
        </div>
        <div class="form-group">
            <label for="">Tipo</label>
            <select name="tipo" id="">
                <option value="residencial">Residencial</option>
                <option value="comercial">Comercial</option>
            </select>
        </div><!--form-group-->
        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" name="preco">
        </div><!--form-group-->
        <div class="form-group">
            <label for="">Imagem:</label>
            <input type="file" name="imagem">
        </div><!--form-group-->
        <div class="form-group">
            <input type="submit" value="Enviar!" name="acao">
        </div><!--form-group-->

    </form>


</div><!--box-content-->