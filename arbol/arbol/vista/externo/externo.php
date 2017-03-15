<html>
<head>
<link rel="stylesheet" type="text/css" href="../../vista/css/pagina.css"/>
<link rel="stylesheet" type="text/css" href="../../vista/css/externo.css"/>
<title>P&aacute;gina Principal</title>
</head>
<body>
	<div>
		<header>
			Bienvenidos a L&iacute;nea Prim&aacute;ria
		</header>
		<nav>
			<ul>
			<li><a href="./principal.php?nav=externo/principal">Principal</a></li>
			<li><a href="./principal.php?nav=externo/pagos">Lista Pagos</a></li>
			<li><a href="./principal.php?nav=externo/faltantes">Lista Faltanes</a></li>
			<li><a href="./principal.php?nav=usuario/login">Login</a></li>
			<ul>
		</nav>
		<div>
			<main>
				<div>
					<?php echo $body ?>
				</div>	
			</main>
			<aside>
				<article>
					
				</article>
			</aside>
		</div>
		<footer>
			L&iacute;nea Prim&aacute;ria 2016 - 2017 
		</footer>
	</div>
</body>
</html>
