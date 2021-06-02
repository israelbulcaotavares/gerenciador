<?php
if(empty($_SESSION['cLogin'])) {
	header("Location: login.php");
	exit;
}

$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$id_anuncio = $a->excluirFoto($_GET['id']);
}

if(isset($id_anuncio)) {
	header("Location: admeditaranuncio?id=".$id_anuncio);
} else {
	header("Location: admbanner");
}