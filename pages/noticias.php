<?php
	$url = explode('/',$_GET['url']);
	if(!isset($url[2]))
	{
	$categoria = Msql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$categoria->execute(array(@$url[1]));
	$categoria = $categoria->fetch();
?>

<section class="header-noticias">
    <div class="centre">
        <h2><i class="fa fa-bell-o" aria-hidden="true"></i></h2>
        <h2>Acompanhe as ultimas notícias do portal</h2>
    </div><!--center-->
</section>

<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3 class=><i class="fa fa-search " aria-hidden="true"></i> Realizar uma busca</h3>
                    <form method="post" action="">
                        <input type="text " name="parametro" placeholder="O que Deseja procurar?" required>
                        <input type="submit" value="Pesquisar" name="buscar">
                    </form>
            </div><!--box-content-siderbar-->

            <div class="box-content-sidebar">
                <h3><i class="fa fa-list-ul" aria-hidden="true"></i> selecione a categoria</h3>
                    <form action="">
                    <select name="categoria" id="">
                        <option value="" selected="">Todas as categorias</option>
                        <?php
								$categorias = Msql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
								$categorias->execute();
								$categorias = $categorias->fetchAll();
								foreach ($categorias as $key => $value) {
								
							?>
								<option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug'] ?>"><?php echo $value['nome']; ?></option>
							<?php } ?>

                </select>
                        
                    </form>
            </div><!--box-content-siderbar-->

            <div class="box-content-sidebar">
                <h3><i class="fa fa-user" aria-hidden="true"></i> Sobre o autor:</h3>
                    <div class="autor-box-portal">
                        <div class="box-img-autor img">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $usuario['img']; ?>" alt="">
                        </div><!--box-img-autor-->
                        <div class="texto-autor-portal text-center">
                            <h3><?php echo $infoSite['nome_autor']; ?></h3>
                            <p><?php echo substr($infoSite['descricao'],0,300).'...' ?></p>
                            <a href="<?php echo INCLUDE_PATH; ?>index.php">Leia mais</a>

                        </div><!--texto-autor-portal-->
                    </div><!--autor-box-portal-->
            </div><!--box-content-siderbar-->
        </div><!--sidebar-->

        <div class="conteudo-portal">
            <div class="header-conteudo-portal">
                <?php 
                $porPagina = 3;
                if(!isset($_POST['parametro'])){
                if(@$categoria['nome'] == ''){
                    echo '<h2>Visualizando todos os Posts</h2>';
                }else{
                    echo '<h2>Visualizando Posts em <span>'.$categoria['nome'].'</span></h2>';
                }
                }else{
                    echo '<h2><i class="fa fa-check"></i> Busca realizada com sucesso!</h2>';
                }

                $query = "SELECT * FROM `tb_site.noticias` ";
							if(@$categoria['nome'] != ''){
								$categoria['id'] = (int)$categoria['id'];
								$query.="WHERE categoria_id = $categoria[id]";
							}
							if(isset($_POST['parametro'])){
								if(strstr($query,'WHERE') !== false){
									$busca = $_POST['parametro'];
									$query.=" AND titulo LIKE '%$busca%'";
								}else{
									$busca = $_POST['parametro'];
									$query.=" WHERE titulo LIKE '%$busca%'";
								}
							}
							$query2 = "SELECT * FROM `tb_site.noticias` "; 
							if(@$categoria['nome'] != ''){
									$categoria['id'] = (int)$categoria['id'];
									$query2.="WHERE categoria_id = $categoria[id]";
							}
							if(isset($_POST['parametro'])){
								if(strstr($query2,'WHERE') !== false){
									$busca = $_POST['parametro'];
									$query2.=" AND titulo LIKE '%$busca%'";
								}else{
									$busca = $_POST['parametro'];
									$query2.=" WHERE titulo LIKE '%$busca%'";
								}
							}
                $totalPaginas = Msql::conectar()->prepare($query);
                $totalPaginas->execute();
                $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina); 
                if(!isset($_POST['parametro'])){
                    if(isset($_GET['pagina'])){
                        $pagina = (int)$_GET['pagina'];
                        if($pagina> $totalPaginas){
                            $pagina = 1;
                            }
                        $queryPg = ($pagina - 1 ) * $porPagina;
                        $query.=" ORDER BY order_id ASC LIMIT $queryPg,$porPagina";
                     }else{
                        $pagina = 1;
                        $query.=" ORDER BY order_id ASC LIMIT 0, $porPagina";
                    }
                }else{
                    $query.=" ORDER BY order_id ASC ";
                }
            
                $sql = Msql::conectar()->prepare($query);
                $sql->execute();
                $noticias = $sql->fetchAll();
            ?>
            
                  
            

            </div><!--header-conteudo-portal-->
            <?php 
                foreach($noticias as $key => $value){  
                $sql = Msql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                $sql->execute(array($value['categoria_id']));
                $categoriaNome = $sql->fetch()['slug'];
            ?>
            <div class="box-conteudo">
                    <div class="img-box-conteudo">
                        <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['capa'] ?>" alt="">
                    </div>
                <div class="box-single-conteudo">
                    <h2> <a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>"> <?php echo date('d/m/Y',strtotime($value['data'])); ?> -  <?php echo $value['titulo']; ?></a></h2>
                    
                </div><!--box-single-conteudo-->
                <div class="clear"></div>
            </div><!--box-conteudo-->
            <div class="line"></div>

            <?php } ?>


            <div class="paginator">
            <?php
							if(!isset($_POST['parametro'])){
							for($i = 1; $i <= $totalPaginas; $i++){
								$catStr = (@$categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
								if($pagina == $i)
									echo '<a class="active-page" href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
								else
									echo '<a href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
							}
							}
						?>

            </div><!--paginator-->
        </div><!--conteudo-portal-->
        <div class="clear"></div>
    </div><!--center-->
</section><!--container-portal-->

<?php }else{
    include('noticias-single.php');
}
?>