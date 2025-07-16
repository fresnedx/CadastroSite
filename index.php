<?php
require_once "conexao.php";

$mensagem = "";
$nome = "";
$email = "";
$telefone = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha']; // não usar trim para senha
    $telefone = trim($_POST['telefone']);

    if (empty($nome) || empty($email) || empty($senha) || empty($telefone)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = 'Email inválido.';
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO cadastros (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $mensagem = "Erro na preparação da consulta: " . $conn->error;
        } else {
            $stmt->bind_param("ssss", $nome, $email, $senhaHash, $telefone);
            if ($stmt->execute()) {
                $mensagem = "Cadastro realizado com sucesso!";
                // Limpar dados para não mostrar no formulário após sucesso
                $nome = $email = $telefone = "";
            } else {
                $mensagem = "Erro ao cadastrar: " . $stmt->error;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <?php if (!empty($mensagem)) : ?>
  <div class="mensagem-sucesso">
    <i class="fa-solid fa-circle-check"></i>
    <?php echo htmlspecialchars($mensagem); ?>
  </div>
<?php endif; ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your description" />
    <meta name="author" content="Pedro Henrique Fresneda Ferreira" />
    <meta name="robots" content="noindex, nofollow" />
    <meta
      http-equiv="Content-Security-Policy"
      content="upgrade-insecure-requests"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
        <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
  </head>
  <body>
    <form action="" method="post">
      <h1>Cadastre-se</h1>
      <div class="boxprincipal">
        <div class="icones">
          <i class="fa-solid fa-user"></i>
          <i class="fa-solid fa-check"></i>
        </div>
        <div class="boxsecundaria">
          <div class="boxinput">
          <div class="inputgroup">
            <label for="nome">Nome:</label>
            <input
              type="text"
              id="nome"
              name="nome"
              placeholder="Ex: Pedro Henrique"
              required
            />
            <i class="fa-solid fa-circle-user"></i>
          </div>
          <div class="inputgroup">
            <label for="email">Email:</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Ex: pedrobatata123@gmail.com"
              required
            />
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="inputgroup">
            <label for="senha">Senha:</label>
            <input
              type="password"
              id="senha"
              name="senha"
              placeholder="Ex: Pedro123"
              required
            />
            <i class="fa-solid fa-key"></i>
          </div>
          <div class="inputgroup">
            <label for="telefone">Telefone:</label>
            <input
              type="tel"
              id="telefone"
              name="telefone"
              placeholder="Ex: 11 93578-8769"
            />
            <i class="fa-solid fa-phone"></i>
          </div>
          </div>
          <button type="submit">Cadastrar</button>
        </div>
      </div>
    </form>
  </body>
</html>
