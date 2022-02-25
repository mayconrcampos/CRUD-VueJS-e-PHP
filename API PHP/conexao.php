<?php

$host = "localhost";
$user = "root";
$senha = "5DaJ10.,Xw,8";
$dbname = "crude";
$porta = "3306";

// Tem hospedagens que não precisa botar a porta. Verificar com a hospedagem.

// Conexão com a porta
$conn = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $senha);