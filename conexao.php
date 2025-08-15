<?php

// Configurações do banco
$servername = "localhost";
$username = "root";       // usuário padrão no XAMPP
$password = "";           // senha padrão no XAMPP é vazia
$dbname = "login_cadastro"; // coloque o nome do seu banco de dados aqui

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

//echo "Conectado com sucesso!";

?>


//ESSE BANCO NÃO EXISTE, SOMENTE PARA USO DE PORTFOLIO
