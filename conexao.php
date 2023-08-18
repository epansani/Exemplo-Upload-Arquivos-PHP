<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$base = "exemploUpload";

$conn = mysqli_connect($servidor, $usuario, $senha, $base);

if (!$conn) {
    exit("Erro ao conectar ao Banco de Dados!");
}