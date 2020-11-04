<?php
    require_once 'CLASSES/users.php';
    $u = new User;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/forms.css">
    <link rel="shortcut icon" href="./images/senha.svg"/>
    <title>Sistema de Login</title>
</head>
<body>
    <div class="container">
        <h1>Sistema de Login e Cadastro</h1>
        <form method="POST"  class="form-block">
            <input type="email" name="email" placeholder="Email" maxlength="40" required>
            <input type="password" name="senha" placeholder="Senha" maxlength="15" required>
            <input type="submit" id="buttom-form" value="Acessar">
        </form>
        <h4>Não possui um cadastro? </h4>
        <a href="./cadastro.php" id="link-cadastro">Criar agora</a>
    </div>
    <ul class="squares"></ul>
<?php
    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        //verificar se está vazio
        if(!empty($email) && !empty($senha)) 
        {
            $u->connect("DBNAME","HOST","USER","PASSWORD");
            if($u->msgError == "")
            {
                if($u->login($email, $senha))
                {
                    header("location: privateArea.php");
                }
                else
                {
                    ?>
                        <div class="msg-error">
                            Email e/ou senha incorretos!
                        </div>                    
                    <?php
                }
            }
            else 
            {
                ?>
                    <div class="msg-error">
                        <?php echo "Erro ".$u->msgError; ?>
                    </div>                    
                <?php
            }
            
        }
        else
        {
            ?>
                <div class="msg-error">
                    Email ou senha faltando!
                </div>                    
            <?php
        }
    }
?>
    <script src="script.js"></script>
</body>
</html>