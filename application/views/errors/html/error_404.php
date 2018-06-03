<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page not found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container{
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
	max-width:500px;
	margin:0 auto;
	position:relative;
}

p {
	margin: 12px 15px 12px 15px;
}
#er-head{
    font-size: 400%;
    width: 100px;
    display: block;
    height: 100px;
    text-align: center;
    line-height: 100px;
    border: 3px dashed #EEE;
    border-radius: 50%;
    background: #FF5722;
    color: #FFF;
    box-shadow: 1px 1px 10px #e2e2e2;
    position: absolute;
    left: 6px;
    top: 3px;
}
.er-text{
    padding-left: 110px;
    padding-top: 23px;
}
</style>
</head>
<body>
	<div id="container">
    	<div id="er-head">404</div>
        <div class="er-text">
		<h1>Page not found</h1>
		<?php 
		error_reporting(E_ALL);
		ini_set('display_errors', 1); ?>
        <p>the page your seeking is not exist</p>
        </div>
	</div>
</body>
</html>