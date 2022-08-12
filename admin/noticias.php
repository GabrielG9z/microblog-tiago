<?php
use Microblog\Noticia;
use Microblog\Utilitarios;
require_once "../inc/cabecalho-admin.php";

$noticia = new Noticia;

/* Capturando o id e o tipo do usuário logado
e associando estes valores às propriedades do objeto usuario */
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);


$listaDeNoticias = $noticia->listar();


?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?=count($listaDeNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Titulo</th>
                        <th>Data</th>
                        <?php if($_SESSION['tipo'] === 'admin') { ?>
						<th>Autor</th>
						<?php } ?>
						<th class="text-center">Destaque</th>
						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>
<?php foreach ($listaDeNoticias as $noticias) {
	
?>


					<tr>
                        <td><?=$noticias['titulo']?> </td>

						<!-- Funcão date, formatamos a data do banco de dados para nosso formato padrão d/m/Y, logo após passamos outra função para converter a string, dentro dela passamos um argumento para que a função seja realizada -->
                        <td> <?=Utilitarios::formataData($noticias['data'])?> </td>

						
						<?php if($_SESSION['tipo'] === 'admin') { ?>

							<!-- Operador de Coalescência Nula:
					Na prática, o valor à esquerda é exibido (desde que ele exista), caso contrário o valor à direita é exibido -->
								<td> 
									<?php if($noticias['autor']){
									echo Utilitarios::limitaCaracter($noticias['autor']);
								} else {
									echo "<i>Equipe Microblog</i>";
								} ?> </td>
								
						<?php } ?>

						<td> <?=$noticias['destaque']?> </td>
						<td class="text-center">
							<a class="btn btn-primary" 
							href="noticia-atualiza.php?id=<?=$noticias['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?=$noticias['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
				<?php }?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

