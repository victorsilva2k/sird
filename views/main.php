<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_CSS; ?>main.css">
  

    <!-- Links Externos -->
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Javascript -->
    <script src="<?php echo ROOT_JS; ?>jquery-3.2.1.js"></script>
    <script src="<?php echo ROOT_JS; ?>app.js"></script>

    <!-- Icones -->
    <script src="https://kit.fontawesome.com/d48820cda4.js" crossorigin="anonymous"></script>
    <title>SIRD - PNA</title>
</head>

<body>

    <div class="modal">
    
    </div>
    
    <div class="conteudo">
        <?php if(isset($_SESSION['is_logged_in'])): ?>
            <nav class="barra-lateral">
                <div class="cabecalho__link-aplicacao">
                    
                    <!-- PARA O agente -->
                    
                    <a href="" class="cabecalho__link">
                        <div class="cabecalho__nav">
                            <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="Aplicação" class="cabecalho__logo cabecalho__img">
                            <span class="cabecalho__nome-aplicacao">SIRD</span>
                        </div>
                    </a>
                    
                    <button class="cabecalho__botao btn-icone esconde-grande">
                        <svg class="cabecalho__icone icone--padrao">
                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-menu"></use> 
                        </svg>
                    </button>
                
                    
                
                </div>
                <ul class="navegacao-lateral">
                    <li class="navegacao-lateral__item">
                        <a href="<?php echo ROOT_URL; ?>documentos" class="navegacao-lateral__link">
                            <svg class="navegacao-lateral__icone">
                                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                            </svg>
                            <span>Documentos</span>
                        </a>
                    </li>
                    <li class="navegacao-lateral__item">
                        <a href="<?php echo ROOT_URL; ?>postos" class="navegacao-lateral__link">
                            <svg class="navegacao-lateral__icone">
                                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use>
                            </svg>
                            <span>Postos</span>
                        </a>
                    </li>
                    
                    <?php if($_SESSION['usuario_local']['tipo_local'] === "comando"): ?>
                    <li class="navegacao-lateral__item">
                        <a href="<?php echo ROOT_URL; ?>agentes" class="navegacao-lateral__link">
                            <svg class="navegacao-lateral__icone">
                                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-user"></use>
                            </svg>
                            <span>agentes</span>
                        </a>
                    </li>
                    <?php endif;?>
                    <li class="navegacao-lateral__item">
                        <a href="<?php echo ROOT_URL; ?>comando" class="navegacao-lateral__link">
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

                <ul class="navegacao-lateral">
                    <li class="navegacao-lateral__item">
                        <a href="<?php echo ROOT_URL; ?>agentes/sair" class="navegacao-lateral__link">
                            <svg class="navegacao-lateral__icone">
                                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                            </svg>
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </nav>
      
        <?php endif;?>
        

        <main role="main" class=" main">
                <header class=" cabecalho--top">

                    <div class=" cabecalho">
                    <?php if(isset($_SESSION['is_logged_in'])): ?>
                        
                        
                        <div class="cabecalho-direito cont cont--side">
                            
                            <form class="pesquisa-form" action="pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
                                <button class="pesquisa-form__botao btn-icone">
                                    <svg class="pesquisa-form__icone  icone-padrao">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                                    </svg>
                                </button>
                                
                            </form> 
                            <div class="cabecalho-direito__links-direito">
                                
                            <a href="#" class="cabecalho-direito__botao-menu esconde-grande" id="abrir-menu">
                                <!-- HACK -->
                                <svg class="cabecalho-direito__icone  icone-padrao">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-list"></use> 
                                </svg>
                            </a>
                            <div class="cabecalho-direito__links-2">
                                <a href="" class="pesquisa-form__botao--normal btn btn-primary mb-4 ">Publicar</a>
                                <a href="" class="cabecalho__link-usuario">
                                    <div class="cabecalho__nav cabecalho__usuario-nav mge-10">
                                        <span class="cabecalho__nome-usuario"><?php echo $_SESSION['dados_usuario']['nome']; ?></span>
                                        <img src="<?php echo ROOT_IMG; ?>site/<?php echo $_SESSION['dados_usuario']['foto']; ?>" alt="Foto Usuário" class="cabecalho__foto-usuario cabecalho__img">
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                    <?php else:?>
                            <div class="cabecalho-direito cont cont--side">
                            <!-- PARA O CIDADÃO -->
                            <button class="cabecalho__botao btn-icone esconde-grande">
                                <svg class="cabecalho__icone icone--padrao">
                                <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                                </svg>
                            </button>  
                            <form class="pesquisa-form" action="pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
                                <button class="pesquisa-form__botao btn-icone">
                                    <svg class="pesquisa-form__icone  icone-padrao">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                                    </svg>
                                </button>
                                
                            </form> 

                            
                        </div>
                    <?php endif;?>
                    </div>

                </header>
                
            
                
                <?php 
                echo '<div class="cont mgt-20 mgb-20">';
                
                Messages::displayMessage();
                require $view; 
                echo '</div>';
                ?>
            

        </main><!-- /.container -->
    </div>
</body>

</html>