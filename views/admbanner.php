<?php
if(empty($_SESSION['cLogin'])) {
	?>
	<script type="text/javascript">window.location.href="admlogin";</script>
	<?php
	exit;
}
?>
<div class="container">
	<h1>Área de Banner</h1>

	<a href="admaddAnuncio" class="btn btn-default">Adicionar Banner</a>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Imagem</th>
				<th>LINK</th>
			</tr>
		</thead>
		<?php
		$a = new Anuncios();
		$anuncios = $a->getMeusAnuncios();

		foreach($anuncios as $anuncio):
		?>
		<tr>
			<td>
				<?php if(!empty($anuncio['url'])): ?>
				<img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" />
				<?php else: ?>
				<img src="assets/images/default.jpg" height="50" border="0" />
				<?php endif; ?>
			</td>
			<td><?php echo $anuncio['titulo']; ?></td> 
			<td>
				<a href="admeditaranuncio?id=<?php  echo $anuncio['id']; ?>" class="btn btn-success">Editar</a>
				<a href="admexcluiranuncio?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Excluir</a> 
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div> 