<style>
    .principal {
     margin-left: auto; 
     margin-top: 0; 
    }
    c.navegacao-lateral__botao, .pesquisa-form__botao--normal, .barra-lateral {
        display: none !important;
    }
</style>

    <div class="img-principal mx-auto">
        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="">
        <h1>SIRD</h1>
    </div>
    
    
    <nav class="navbar" >
            
    <form class="pesquisa-form" action="pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
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
                <a href="<?php echo ROOT_URL; ?>documentos/ver/<?php echo $id_proprietario; ?>" class="responsive-item ">
                    <div class="cartoes__cartao br-25 ">
                        <div class="cartoes__div-img">
                            <img     class="cartoes__img img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto; ?>" alt="Nome do Cidadão">
                        </div>
                        <div class="cartoes__texto">
                            <ul class="cartoes__lista">
                                <li>Nome: <?php echo $nome_completo; ?></li>
                                <li>Documentos: <?php echo $categorias; ?></li>
                            </ul>
                        </div>
                        
                    </div>
                </a>
            <?php endforeach;?>
            
        

<div class="selectors">
            <a href="1"><i class="fas fa-chevron-left"></i></a>
            <a href="1">1</a>
            <a href="2">2</a>
            <a href="3">3</a>
            <a href="4">4</a>
            <a href="5">5</a>
            <a href="6"><i class="fas fa-chevron-right"></i></a>
        </div>

<style>
    header {
        display: none;
    }
</style>