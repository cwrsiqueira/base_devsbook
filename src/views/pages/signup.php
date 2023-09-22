<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cadastro | Familybook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/login.css" />
    <link rel="shortcut icon" href="<?= $base; ?>/assets/images/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <div class="container">
            <a href=""><img src="<?= $base; ?>/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">

        <form method="POST">

            <?php if (!empty($flash)) : ?>
                <div class="alert"><?php echo $flash; ?></div>
            <?php endif; ?>

            <input placeholder="Digite seu nome" class="input" type="text" name="name" />

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua data de nascimento" class="input" type="text" name="birthdate" id="birthdate" />

            <input class="button" type="submit" value="Fazer cadastro" />

            <a href="<?= $base; ?>/login">Já tem conta? Faça o login</a>
        </form>
    </section>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.querySelector('#birthdate'), {
                mask: '00/00/0000'
            }
        )
    </script>
</body>

</html>