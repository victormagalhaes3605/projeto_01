<div class="box-content">

	<?php
		if(isset($_GET['email'])){
			$parcela_id = (int)$_GET['parcela'];
			$cliente_id = (int)$_GET['email'];
			if(isset($_COOKIE['cliente_'.$cliente_id])){
				Painel::alert('erro', 'Você já enviou um email cobrando esse cliente');

				
			}else{
				
				//Podemos enviar o e-mail
			$sql = MSql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE id = $parcela_id");
			$sql->execute();
			$infoFinanceiro = $sql->fetch();
			$sql = MSql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` WHERE id = $cliente_id");
			$sql->execute();
			$infoCliente = $sql->fetch();
			$corpoEmail = "Olá $infoCliente[nome], você está com um saldo pendente de $infoFinanceiro[valor] com o vencimento para $infoFinanceiro[vencimento].	Entre em contato conosco para quitar sua parcela!";
			$email = new Email('smtp.titan.email','admin@victorwagner.com.br','V@magalhaes15','victor');
			$email->addAdress($infoCliente['email'],$infoCliente['nome']);
			$email->formatarEmail(array('assunto'=>'Cobrança','corpo'=>$corpoEmail));
			$email->enviarEmail();
			Painel::alert('sucesso','E-mail enviado com sucesso!');
			setcookie('cliente_'.$cliente_id,'true',time()+30,'/');
			
			}
		}
	?>


	<h2><i class="fa fa-id-card-o"></i>Pagamentos do sistema</h2>
    <div class="wraper-table">
		<br>
		
		
		<h4><i class="fa fa-pencil"></i> Pagamentos Pedentes</42>
        
		<div class="gerar-pdf">
			<a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL?>gerar-pdf.php?pagamento=pendentes">Gerar PDF</a>
		</div>

	<div class="wraper-table">
		<table>
			<tr>
			<td>Nome do pagamento</td>
            <td>Cliente</td>
            <td>Valor</td>
            <td>Vencimento</td>
            <td>Valor</td>
            <td>Vencimento</td>
            
        </tr>

		<?php 
			$sql = MSql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			

			foreach ($pendentes as $key => $value) {
				$clienteNome = MSql::conectar()->prepare("SELECT `nome`,`id` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
				$clienteNome->execute();
				$info = $clienteNome->fetch();
				$clienteNome = $info['nome'];
				$idCliente = $info['id'];
				$style="";
				if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
					$style = 'style="background-color:#ff7070;font-weight:bold;"';
				}
			
				
			
		?>
		 <tr <?php echo $style; ?>>
            <td><?php echo $value['nome'];?></td>
            <td><?php echo $clienteNome;?></td>
            <td><?php echo $value['valor'];?></td>
            <td><?php echo date('d/m/Y',strtotime($value['vencimento']));?></td>
			<td><a class="btn-email" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos?email=<?php echo $info['id']; ?>&parcela=<?php echo $value['id']; ?>"><i class="fa fa-envelope"></i>Email</a></td>
            <td><a class="btn-check"  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $id; ?>&pago=<?php echo $value['id']; ?>">
            <i class="fa fa-check"></i>Pago</a></td>
             
        </tr>

		
			
		<?php } ?> 
		 

		
			
		
    </table>
    </div><!--wraper-table-->

	<h4><i class="fa fa-pencil"></i> Pagamentos Concluidos</h4>

	<div class="gerar-pdf">
			<a href="<?php echo INCLUDE_PATH_PAINEL?>gerar-pdf.php?pagamento=concluidos" target="_blank">Gerar PDF</a>
		</div>

	<div class="wraper-table">
    <table>
        <tr>
            <td>Nome do pagamento</td>
            <td>Cliente</td>
            <td>Valor</td>
            <td>Vencimento</td>
            
            
             

			<?php 
			$sql = MSql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1 ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			

			foreach ($pendentes as $key => $value) {
				$clienteNome = MSql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
				$clienteNome->execute();
				$clienteNome = $clienteNome->fetch()['nome'];
				$style="";
				if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
					$style = 'style="background-color:#ff7070;font-weight:bold;"';
				}
			
				
			
		?>
		 <tr <?php echo $style; ?>>
            <td><?php echo $value['nome'];?></td>
            <td><?php echo $clienteNome;?></td>
            <td><?php echo $value['valor'];?></td>
            <td><?php echo date('d/m/Y',strtotime($value['vencimento']));?></td>
			
            
        </tr>

		
		<?php } ?> 
			
	

		
			
	

        

        
    </table>
    </div><!--wraper-table-->
	


     
</div><!--box-content-->