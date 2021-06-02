<?php
if(empty($_SESSION['cLogin'])) {
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit;
}

$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
	$titulo = addslashes($_POST['titulo']);
	
 
 
	if(isset($_FILES['fotos'])) {
		$fotos = $_FILES['fotos'];
	} else {
		$fotos = array();
	}

	$a->addAnuncio($titulo,  $fotos);
	header("Location: admbanner");
	?>
	<div class="alert alert-success">
		Adicionado com sucesso!
	</div>
	<?php
}
?>
<div class="container">
	<h1>Meus Post - Adicionar Post</h1>

	<form method="POST" enctype="multipart/form-data">

		 
		<div class="form-group">
			<label for="titulo">Link da LIVE:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" />
		</div>
		 
		<label for="add_foto">Imagem da Live:</label><button type="button" class="btn btn-danger">Dimensão da imagem sugerida: 1900x1200
</button>
			<input type="file" name="fotos[]"   /><br/>
		<input type="submit"  value="Adicionar" class="btn btn-default" />
	</form>

</div> 
