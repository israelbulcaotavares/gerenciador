<?php
if(empty($_SESSION['cLogin'])) {
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
	$titulo = addslashes($_POST['titulo']);
 	 
	if(isset($_FILES['fotos'])) {
		$fotos = $_FILES['fotos'];
	} else {
		$fotos = array();
	}

	$a->editAnuncio($titulo, $fotos, $_GET['id']);

	?>
	<div class="alert alert-success">
		Editado com sucesso!
	</div>
	<?php
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$info = $a->getAnuncio($_GET['id']);
} else {
	?>
	<script type="text/javascript">window.location.href="meus-anuncios.php";</script>
	<?php
	exit;
}
?>
<div class="container">
	<h1>Editar Banner</h1>

	<form method="POST" enctype="multipart/form-data">

		 
		<div class="form-group">
			<label for="titulo">Titulo:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>" />
		</div>
		 
		 
		<div class="form-group">
			<label for="add_foto">Banner:</label><button style="margin-left: 5px;" type="button" class="btn btn-danger">Dimensão da imagem sugerida: <strong>1900x1200</strong> 
</button>
			<input type="file" name="fotos[]"  /><br/>

			<div class="panel panel-default">
				<div class="panel-heading">Imagem</div>
				<div class="panel-body">
					<?php foreach($info['fotos'] as $foto): ?>
					<div class="foto_item">
						<img src="assets/images/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail" border="0" /><br/>
						<a href="excluir-foto?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir Imagem</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<input type="submit" value="Salvar" class="btn btn-default" />
	</form>

</div>