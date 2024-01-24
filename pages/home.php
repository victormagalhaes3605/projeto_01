

<section class="banner-container">


            <div style="background-image: url('https://sistema.victorwagner.com.br/painel/uploads/654a71576eb87.avif');" class="banner-single"></div><!--banner-single-->
            
                        <div style="background-image: url('https://sistema.victorwagner.com.br/painel/uploads/654a71623185b.jpg');" class="banner-single"></div><!--banner-single-->
            
                        <div style="background-image: url('https://sistema.victorwagner.com.br/painel/uploads/654a716adda19.avif');" class="banner-single"></div><!--banner-single-->
            
                
    
            
            
     
            
            <!-- <form  method="post">
                <h2>Qual o seu e-mail</h2>
                <input type="email" name="email" >
                <input type="hidden" name="email" required value="form_home">
                <input type="submit" name="acao" value="cadastar">
            </form> -->
            
            <div class="descricao-autor" >
                
                <div class="w100 ">
                    <img  src="https://sistema.victorwagner.com.br/imagens/vm.png" >
                </div><!--w100-->
                <div class="w100 left">
                    <h2>Victor Magalhães</h2>
                    <p>Você precisa de um site ou aplicativo web? Então você está no lugar certo! Com habilidades em programação orientada a objetos e banco de dados, ele pode criar soluções personalizadas para suas necessidades. O PHP é uma linguagem livre e de código aberto, o que significa que você não precisa se preocupar com taxas de licenciamento. Entre em contato comigo hoje e comece a transformar suas ideias em realidade.</p>
                </div><!--w100-->
                
                
                <div class="clear"></div>   
            </div><!--center-->
            <div class="overlay"></div>
        </div><!--descricao-autor-->
        
                
        
</section><!--banner-princiapal-->



<section class="especialidades" >
    <h2 class="title">Especialidades</h2>
    <div class="center ">
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone1']; ?>" aria-hidden="true"></i></h3>
            <h4>Css3</h4>
            <p><?php echo $infoSite['descricao1']; ?></p>
        </div><!--box-especialidade-->
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone2']; ?>" aria-hidden="true"></i></h3>
            <h4>Html</h4>

            <p><?php echo $infoSite['descricao2']; ?></p>
        </div><!--box-especialidade-->
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone3']; ?>" aria-hidden="true"></i></h3>
            <h4>JavaScript</h4>
            <p><?php echo $infoSite['descricao3']; ?></p>
        </div><!--box-especialidade-->
        <div class="clear"></div>   
    </div><!--center-->

</section><!--especialidades-->

<section class="extras">

    <div class="center ">
        <div id="depoimentos" class="w50 left depoimentos-container">
            <h2 class="title">Depoimentos</h2>
            <?php
                $sql = Msql::conectar()->prepare('SELECT * FROM `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3');
                $sql->execute();
                $depoimentos = $sql->fetchAll();
                foreach ($depoimentos as $key => $value){
                    
                ?>
                    <div class="depoimentos-single">
                        <p class="depoimento-descricao">"<?php echo $value['depoimento']; ?>"</p>
                        <p class="nome-autor">"<?php echo $value['nome']; ?> - "<?php echo $value['data']; ?></p>
                    </div><!--depoimento-single-->
                <?php } ?>


        </div><!--w50-->
        <div class="w50 left servicos-container">
            <h2 class="title">Seviços</h2>
            <div id="servicos"  class="servicos">
                <ul>
                    <?php 
                        $sql = Msql::conectar()->prepare('SELECT * FROM `tb_site.servicos` ORDER BY order_id ASC LIMIT 3');
                        $sql->execute();
                        $servicos = $sql->fetchAll();
                        foreach ($servicos as $key => $value){
                    ?>

                    <li>
                        <?php echo $value['servicos']; ?>
                    </li>
                    <?php } ?>
                </ul>
            </div><!--sevicos-->
        </div><!--w50-->
    <div class="clear"></div>    
    </div><!--center-->

</section><!--extras-->