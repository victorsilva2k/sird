<!DOCTYPE html>
<html lang="pt-pt">
<?php
// HACK
$oficial = true; //verdadeiro
?>
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
    <title>SIRD - PNA</title>
</head>

<body>

    <header class="bg-black">

        <div class=" cabecalho">
            <div class="cabecalho__link-aplicacao">
            <?php if($oficial): ?>
                <!-- PARA O OFICIAL -->
                
                <a href="" class="cabecalho__link">
                    <div class="cabecalho__nav">
                        <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="Aplicação" class="cabecalho__logo cabecalho__img">
                        <span class="cabecalho__nome-aplicacao">SIRD</span>
                    </div>
                </a>
                
                <button class="cabecalho__botao btn-icone esconde-grande">
                    <svg class="cabecalho__icone icone--padrao">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-menu"></use> 
                    </svg>
                </button>
            <?php else:?>
                <!-- PARA O CIDADÃO -->
                <button class="cabecalho__botao btn-icone esconde-grande">
                    <svg class="cabecalho__icone icone--padrao">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use> 
                    </svg>
                </button>  
            <?php endif;?>
            </div>
            
            <div class="cabecalho-direito cont cont--side">
            <form class="pesquisa-form" action="pesquisar" method="get">
                <input class="pesquisa-form__input input--text" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
                <button class="pesquisa-form__botao btn-icone">
                    <svg class="pesquisa-form__icone  icone-padrao">
                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                    </svg>
                </button>
                <a href="" class="pesquisa-form__botao--normal btn btn-secondary mb-4 ">Publicar</a>
            </form> 

            <a href="" class="cabecalho__link-usuario">
                <div class="cabecalho__nav cabecalho__usuario-nav mge-10">
                    <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="Foto Usuário" class="cabecalho__foto-usuario cabecalho__img">
                    <span class="cabecalho__nome-usuario">Victor</span>
                </div>
            </a>
            </div>
        </div>
        
    </header>
    
    <div class="conteudo">
        <nav class="barra-lateral">
            <ul class="navegacao-lateral">
                <li class="navegacao-lateral__item">
                    <a href="#" class="navegacao-lateral__link">
                        <svg class="navegacao-lateral__icone">
                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                        </svg>
                        <span>Documentos</span>
                    </a>
                </li>
                <li class="navegacao-lateral__item">
                    <a href="#" class="navegacao-lateral__link">
                        <svg class="navegacao-lateral__icone">
                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use>
                        </svg>
                        <span>Postos</span>
                    </a>
                </li>
                <li class="navegacao-lateral__item">
                    <a href="#" class="navegacao-lateral__link">
                        <svg class="navegacao-lateral__icone">
                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-user"></use>
                        </svg>
                        <span>Oficiais</span>
                    </a>
                </li>
                <li class="navegacao-lateral__item">
                    <a href="#" class="navegacao-lateral__link">
                        <svg class="navegacao-lateral__icone">
                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-office"></use>
                        </svg>
                        <span>Comando Municipal</span>
                    </a>
                </li>
                <li class="navegacao-lateral__item">

                    <a href="" class="center-t navegacao-lateral__link navegacao-lateral__botao  btn btn-success mb-4 ">Devolver</a>

                </li>
            </ul>

        </nav>
        <main role="main" class=" main">

            
                
                <?php 
                echo '<div class="cont cont--side mgt-20 mgb-20"">';
                
                Messages::displayMessage();
                echo '</div>';
                require $view; 
                
                ?>
            

        </main><!-- /.container -->
    </div>
</body>

</html>