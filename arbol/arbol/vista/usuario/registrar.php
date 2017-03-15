<html>
<head><title>Registrarse</title></head>
<body>
<form action="./registrar.php" method="post">
<table>
<tr><td>usuario</td><td><input type="text" name="usuario" value="<?php echo $usuario; ?>"/><font color="red"><?php echo $msnUsuario; ?></font></td></tr>
<tr><td>contrase&ntilde;a</td><td><input type="password" name="password" value="<?php echo $password; ?>"/><font color="red"><?php echo $msnPassword; ?></font></td></tr>
<tr><td>repita contrase&ntilde;a</td><td><input type="password" name="password2" value=""/><font color="red"><?php echo $msnPassword2; ?></font></td></tr>
<tr><td>celular</td><td><input type="text" name="celular" value="<?php echo $celular; ?>"/><font color="red"><?php echo $msnCelular; ?></font></td></tr>
<tr><td><a href="./login.php">Regresar</a></td>
<td><button>guardar</button>
</td></tr></table>
</form>
</body>
</html>
