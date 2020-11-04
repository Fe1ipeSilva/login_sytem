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
        <a href="./index.php"><img src="images/voltar.png" id="back-buttom"></a>
        <h1>Informe os seus dados</h1> 
        <form method="POST" class="form-block">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30" required/>
            <input type="tel" name="telefone" placeholder="Telefone Celular" maxlength="30" required/>
            <input type="email" name="email" placeholder="Email" maxlength="40" required>
            <input type="password" name="senha" placeholder="Senha" maxlength="15" required>
            <input type="password" name="confSenha" placeholder="Confirme a Senha" maxlength="15" required>
            <input type="submit" id="buttom-form" value="Cadastrar">
        </form>
    </div>
    <ul class="squares"></ul>
<?php
//verificar se clicou botão
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confSenha = addslashes($_POST['confSenha']);
    //verificar se está vazio
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)) 
    {
        $u->connect("epiz_26862343_system_login","sql213.epizy.com","epiz_26862343","r2kJPesIPW");
        if($u->msgError == "")
        {
            if($senha == $confSenha)
            {
                if($u->register($nome, $telefone, $email, $senha))
                {   
                    ?>
                        <div id="msg-sucess">
                            Cadastrado com sucesso! Acesse para entrar.
                        </div>                    
                    <?php
                }
                else 
                {
                    ?>
                        <div class="msg-error">
                            Email já cadastrado!
                        </div>                    
                    <?php
                }
            }
            else 
            {
                ?>
                    <div class="msg-error">
                        As senhas não batem!
                    </div>                    
                <?php
            }
        }
        else 
        {   ?>
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
                Preencha todos os campos!
            </div>                    
        <?php
    }
}
?>
<script src="script.js"></script>
</body>
</html>