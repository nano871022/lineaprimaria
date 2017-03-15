<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
<!--	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/> -->
<!--	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"/>-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-9281622561416271",
enable_page_level_ads:true
});
</script>
<script>
var showMenu = false;
function mostrarMenu(){
if(showMenu){
document.getElementById("menu").classList.remove("menuNow");
document.getElementById("menu").classList.add("menu");
showMenu = false;
}else{
document.getElementById("menu").classList.remove("menu");
document.getElementById("menu").classList.add("menuNow");
showMenu = true;
}
document.cookie = "menu="+showMenu+";";
}
var cookie = document.cookie;
if(cookie.indexOf("menu")){
var t = cookie.split(";");
for(var i = 0; i < t.length; i++){
 if(t[i] == "menu"){
   var v = (t[i]).split("=");
   if(v.length > 1){
	showMenu = v[1];
	}
}
}
}

</script>
	<link rel="stylesheet" type="text/css" href="../../vista/css/pagina.css"/>
	<title>Home</title>
</head>
<body>
<header>
	<div class="contenedor">
		<div >
			<h2>Linea Primaria</h2> Social Networking
		<div class="menu-btn" onclick="mostrarMenu()">Menu</div>
		</div>
		<div class="nombre">
			<?php 
				echo $head;
			?>
		</div>
	</div>
</header>
<nav id="menu" class="menu">
<h2>Menu</h2>
<ul>
<?php 
$menu = unserialize($menu);
if(count($menu)>0){
foreach($menu as $key => $valor){
	?><li>
	<a href="./principal.php?nav=<?php echo $valor; ?>"><?php echo $key; ?></a>
	</li>
	<?php
}}
?>
</ul>
<form method="post" action="./principal.php">
<input type="hidden" name="end" value="1"/>
<button>Finalizar Sesion</button>
</form>
</nav>
<section>
<?php echo $body; ?>
</section>
<footer>
 Derechos Reservados L&iacute;nea Primaria S.N. 2016 (Version 1.1.30 de Enero 2017)
</footer>
</body>
</html>
