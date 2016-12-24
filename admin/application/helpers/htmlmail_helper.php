<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------

if ( ! function_exists('htmlmail'))
{
	
	function htmlmail($mensaje){
		$html='
		<html lang="es">
		<head>
		<style>
			body{
				font-size:13px;
				font-family:arial;
				padding:0px;
				margin:0px;
			}
			#header{
				height:100px;
				width:100%;
				background-color:#000;
			}
			#header h1{
				color:#fff;
				float:left;
				padding-left:20px;
			}
			#logo{
				float:left;
				margin-top:5px;
				margin-left:5px;
			}
			#cuerpo{
				background-color:#fff;
				color:#000;
				min-height:100px;
				padding:15px;
				width:700px;
			}
			#footer{
				height:30px;
				width:100%;
				background-color:#000;
				color:#fff;
				padding:15px;
			}
			#footer-texto{
				width:700px;
			}
		</style>
		</head>
<body>
<div id="header">
	<div id="logo"><a href="http://music-center.com.ar"><img src="http://music-center.com.ar/logoHead.png" width="60" /></a></div>
	<h1>Music-Center Shopping Online </h1>
</div>
<div id="cuerpo">
	' . $mensaje . '
</div>
<div id="footer">
	<div id="footer-texto">
	© 2015 MUSIC-CENTER TODOS LOS DERECHOS RESERVADOS.
MUSIC-CENTER S.A | SARMIENTO 939, ROSARIO, CUIT 30-67992887-9 | EMAIL: INFO@MUSIC-CENTER.COM.AR | TELÉFONO: 0341-4215808
	</div>
</div>

</body>
</html>
		';

	return($html);
	}

}
