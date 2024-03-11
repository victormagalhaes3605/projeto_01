<?php 
include('../config.php');
    $data = array();
    $data['sucesso'] = true;
    $data = '';
    
    
    if(isset($_POST['slug_empreendimento'])){
		//Estamos na página de um empreendimento específico.
		$preco_min = Painel::formatarMoedasBd(str_replace('R$ ','',$_POST['preco_min']));
		if($preco_min === ''){
			$preco_min = 0;
		}
		$preco_max = Painel::formatarMoedasBd(str_replace('R$ ','',$_POST['preco_max']));
		if($preco_max === ''){
			$preco_max = 0;
		}
		$area_min = $_POST['area_min'];
		if($area_min === ''){
			$area_min = 0;
		}
		$area_max = $_POST['area_max'];
		if($area_max === ''){
			$area_max = 0;
		}
		$slug_empreendimento = $_POST['slug_empreendimento'];
		$nome_imovel = $_POST['nome_imovel'];
		$infoEmpreendimento = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE slug = ?");
		$infoEmpreendimento->execute(array($slug_empreendimento));
		$infoEmpreendimento = $infoEmpreendimento->fetch();
		$sql = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE (preco >= ? AND 
			preco <= ?) AND (area >= ? AND area <= ?) AND nome LIKE ? AND empreend_id = ?");
		$sql->execute(array($preco_min,$preco_max,$area_min,$area_max,"%$nome_imovel%",$infoEmpreendimento['id']));
		$imoveis = $sql->fetchAll();
		print($imoveis);

		$data.='<h2 class="title-busca">Listando <b>'.count($imoveis).' imóveis</b> em '.$infoEmpreendimento['nome'].'</h2>';
         
		
		foreach ($imoveis as $key => $value) {
			$imagem = \Msql::conectar()->prepare("SELECT imagem FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
			$imagem->execute();
			$imagem = $imagem->fetch()['imagem'];
			$data.='<div class="row-imoveis">
				<div class="r1">
					<img src="'.INCLUDE_PATH_PAINEL.'uploads/'.$imagem.'" />
				</div>
				<div class="r2">
					<p><i class="fa fa-info"></i> Nome do imóvel: '.$value['nome'].'</p>
					<p><i class="fa fa-info"></i> Área: '.$value['area'].'m²</p>
					<p><i class="fa fa-info"></i> Preço: R$'.\Painel::convertMoney($value['preco']).'</p>
				</div>
			</div><!--row-imoveis-->';
		}
		
	}else{
		//Estamos na página de um empreendimento específico.
		$preco_min = Painel::formatarMoedasBd(str_replace('R$ ','',$_POST['preco_min']));
		if($preco_min === ''){
			$preco_min = 0;
		}
		$preco_max = Painel::formatarMoedasBd(str_replace('R$ ','',$_POST['preco_max']));
		if($preco_max === ''){
			$preco_max = 0;
		}
		$area_min = $_POST['area_min'];
		if($area_min === ''){
			$area_min = 0;
		}
		$area_max = $_POST['area_max'];
		if($area_max === ''){
			$area_max = 0;
		}
		$nome_imovel = $_POST['nome_imovel'];
		$sql = \Msql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE `tb_admin.imoveis`.`preco` >= ? AND 
			`tb_admin.imoveis`.`preco` <= ? AND `tb_admin.imoveis`.`area` >= ? AND `tb_admin.imoveis`.`area` <= ? AND `tb_admin.imoveis`.`nome` LIKE ?");
		$sql->execute(array($preco_min,$preco_max,$area_min,$area_max,"%$nome_imovel%"));
		$imoveis = $sql->fetchAll();

        print_r($imoveis);
		
		$data.='<h2 class="title-busca">Listando <b>'.count($imoveis).' imóveis</b></h2>';

       
		/*
		<div class="row-imoveis">
	<div class="r1">
		<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem; ?>" />
	</div>
	<div class="r2">
		<p><i class="fa fa-info"></i> Nome do imóvel: <?php echo $value['nome']; ?></p>
		<p><i class="fa fa-info"></i> Área: <?php echo $value['area']; ?>m2</p>
		<p><i class="fa fa-info"></i> Preço: R$<?php echo \Painel::convertMoney($value['preco']); ?></p>
	</div>
</div><!--row-imoveis-->
*/
		foreach ($imoveis as $key => $value) {
			$imagem = \Msql::conectar()->prepare("SELECT imagem FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
			$imagem->execute();
			$imagem = $imagem->fetch()['imagem'];
			$data.='<div class="row-imoveis">
				<div class="r1">
					<img src="'.INCLUDE_PATH_PAINEL.'uploads/'.$imagem.'" />
				</div>
				<div class="r2">
					<p><i class="fa fa-info"></i> Nome do imóvel: '.$value['nome'].'</p>
					<p><i class="fa fa-info"></i> Área: '.$value['area'].'m²</p>
					<p><i class="fa fa-info"></i> Preço: R$'.\Painel::convertMoney($value['preco']).'</p>
				</div>
			</div><!--row-imoveis-->';
		}
		
	}


    echo $data;
	
 ?>