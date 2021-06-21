    <style>

        c.navegacao-lateral__botao, .pesquisa-form__botao--normal, .barra-lateral, .cabecalho-direito__links-direito {
            display: none !important;
        }

        .cabecalho--top {
            width: 100% !important;
            
        }

        .principal {
            margin-left: auto !important;
        }
        .cabecalho-direito__agente {
            display: none !important;
        }
        .cabecalho-direito__agente {
            display: none !important;
        }

        .cabecalho-direito__cidadao {
            display: flex;
        }

        @media (max-width: 576px) {
        .cabecalho-direito {
                display: flex;
                flex-direction: column-reverse;
                justify-content: space-between;
            }
        }
    </style>
    <div class="img-principal mx-auto">
        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="">
        <h1>SIRD</h1>
    </div>
    
    
    <nav class="navbar" >
            
    <form class="pesquisa-form" action="<?php echo ROOT_URL; ?>cidadaos/pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar" id="" placeholder="Pesquisar por nome, BI, Número">
                                <button class="pesquisa-form__botao btn-icone">
                                    <svg class="pesquisa-form__icone  icone-padrao">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                                    </svg>
                                </button>
                                
                            </form> 
  
    </nav>

        <div class="galeria cartoes"> 
            <?php foreach($viewmodel as $item) : extract($item);
                $foto_array = explode(",",$fotos);
                $foto = $foto_array[0];
            ?>
                <a href="<?php echo ROOT_URL; ?>cidadaos/ver/<?php echo $id_proprietario; ?>" class="responsive-item ">
                    <div class="cartoes__cartao br-25 ">
                        <div class="cartoes__div-img">
                            <img     class="cartoes__img img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto; ?>" alt="Nome do Cidadão">
                        </div>
                        <div class="cartoes__texto">
                            <ul class="cartoes__lista">
                                <li>Nome: <?php echo $nome_completo; ?></li>
                                <li>Documentos: <?php echo $this->verificarRepeticao($categorias); ?></li>
                            </ul>
                        </div>
                        
                    </div>
                </a>
            <?php endforeach;?>
            
        

<style>
    header {
        display: none;
    }
</style>