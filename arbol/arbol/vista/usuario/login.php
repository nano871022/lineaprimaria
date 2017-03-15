<html>
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-9281622561416271",
enable_page_level_ads:true
});
</script>
<title>
Acceder Aplicacion
</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<form action="../../controlador/usuario/login.php" method="post">
<table>
<tr><td>
usuario
</td><td>
<input type="text" name="usuario" value="<?php echo $usuario;?>"/>
<font color="red"><?php echo $msnUsuario; ?></font>
</td></tr>
<tr><td>
contrase&ntilde;a
</td><td>
<input type="password" name="password" value="<?php echo $password; ?>"/>
<font color="red"><?php echo $msnPassword; ?></font>
</td></tr>
<tr><tr><td>
<a href="./registrar.php">Registrarse</a>
</td><td >
<button>
Ingresar
</button>
</td></tr></table>
</form>
</body>
</html>
