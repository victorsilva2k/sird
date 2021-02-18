<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/main.css">

    <!-- Links Externos -->
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Icones -->
    <script src="https://kit.fontawesome.com/d48820cda4.js" crossorigin="anonymous"></script>
    <title>Shareboard</title>
</head>

<body>

    <header class="bg-black">
        <div class="cont header">
            <button class="header__button btn--icon">
                <svg class="header__icon icon--padrao">
                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use> 
                </svg>
            </button>
            <form class="search-form" action="pesquisar" method="get">
                <input class="search-form__input" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
                <button class="search_form__button btn--icon">
                        <svg class="search_form__icon  icon-padrao">
                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                        </svg>
                </button>
            </form> 
        </div>
        

    </header>
    <main role="main" class="">

        <div class="row">
            
            <?php 
            
            Messages::displayMessage();
            require $view; 
            
            ?>
        </div>

    </main><!-- /.container -->
</body>

</html>