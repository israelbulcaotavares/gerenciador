<html>
<head>
	<title>Painel</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>
	<nav style="background-color: #333;" id="container_fluid" class="navbar navbar-inverse">
		<div  style="background-color: #333;" id="container_fluid" class="container-fluid">
			<div class="navbar-header">
				<a style="color: #fff" href="./admbanner" class="navbar-brand">Painel Gerenciador</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?> 
 					<li><a style="color: #fff" href="admbanner">Banner</a></li>
					<li><a style="color: #fff" href="admsair">Sair</a></li>
				<?php else: ?>
					<li><a style="color: #fff" href="cadastre-se">Cadastre-se</a></li>
					<li><a style="color: #fff" href="admlogin">Login</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>


				<?php $this->loadViewInTemplate($viewName, $viewData); ?>



	</body>
</html>