<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>


<style>

@font-face {
    font-family: 'brush';
    src: url("./vendor/fontes/brush.ttf");
}


.menu{

position: relative;
margin: auto;
max-width: 250px;
width: 100%;
top: 100px;
background-color: white;
text-align: center;
border-radius: 15px;

}

.menu input[type="submit"]{

display: block;
margin-top: 5px;
font-family: brush;
font-size: 18px;


}

.menu input[type="text"], input[type="email"], input[type="password"]{

background-color: black;
color: white;
border-radius: 5px;

}

.menu label{

display: block;
font-family: brush;
font-size: 25px;
color: black;


}

body{

background-color: black;


}

</style>

</head>
<body>


<script type="text/javascript" src="./vendor/vanilla-masker.js"></script>



<div class="menu">

<a href="./index.php"> <img src="https://cdn.pixabay.com/photo/2016/12/14/10/39/button-1905961_960_720.png" width="30"> </a>

<form action="./app/controls/configLogin.php/" method="post">

<label for="">Email </label>
<input type="email"  id="email " name="email" required>

<label for="">Senha</label>
<input type="password"  name="senha" required>


<center> <input type="submit" name="submit" value="Entrar"> </center>


</form>



</div>



    
</body>
