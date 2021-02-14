<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/estilo.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/base.css">

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
        <div class="cont">
        <nav class="navbar" >

            
            <form class="search-form" action="pesquisar" method="get">
                <button class="btn btn-1" type="submit"><i class="fas fa-home"></i></button>
                <input class="form-input" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
                <button class="btn btn-1" type="submit">Pesquisar</button>
            </form>
            
      
        </nav>
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