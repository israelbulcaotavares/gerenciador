<?php
if(empty($_SESSION['cLogin'])) {
	header("Location: login");
	exit;
}

$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$a->excluirAnuncio($_GET['id']);
}

header("Location: admbanner");

 