<style>
    .principal {
     margin-left: auto; 
     margin-top: 0; 
    }
</style>
<div class="cont">
    <div class="img-principal mx-auto">
        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="">
        <h1>SIRD</h1>
    </div>
    
    
    <nav class="navbar" >
            
        <form class="pesquisa-form" action="pesquisar" method="get">
            <input class="pesquisa-form__input input--text" type="text" name="pesquisar_documento" id="" placeholder="Pesquisar por nome, BI, Número">
            <botao class="search_form__botao btn-icone">
                    <svg class="search_form__icone icone--padrao">
                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                    </svg>
                </button>
        </form>
  
    </nav>
    <a href="" class="btn btn-secondary mb-4 ">Ordenar por</a>

        <div class="galeria cartoes"> 
            <a href="<?php echo ROOT_PATH; ?>documentos/id/192" class="responsive-item ">
                <div class="cartoes__cartao br-25 ">
                    <div class="cartoes__img">
                        <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="nome da pessoa">
                    </div>
                    <div class="cartoes__texto">
                        <ul class="cartoes__lista">
                            <li>Nome: Victorino Kioza</li>
                            <li>Documentos: BI, Carta de Condução</li>
                        </ul>
                    </div>
                    
                </div>
            </a>
            <a href="<?php echo ROOT_PATH; ?>documentos/id/192" class="responsive-item ">
                <div class="cartoes__cartao br-25 ">
                    <div class="cartoes__img">
                        <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="nome da pessoa">
                    </div>
                    <div class="cartoes__texto">
                        <ul class="cartoes__lista">
                            <li>Nome: Victorino Kioza</li>
                            <li>Documentos: BI, Carta de Condução</li>
                        </ul>
                    </div>
                    
                </div>
            </a>
            <a href="<?php echo ROOT_PATH; ?>documentos/id/192" class="responsive-item ">
                <div class="cartoes__cartao br-25 ">
                    <div class="cartoes__img">
                        <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="nome da pessoa">
                    </div>
                    <div class="cartoes__texto">
                        <ul class="cartoes__lista">
                            <li>Nome: Victorino Kioza</li>
                            <li>Documentos: BI, Carta de Condução</li>
                        </ul>
                    </div>
                    
                </div>
            </a>
            
        </div>
        <div class="selectors">
            <a href="1"><i class="fas fa-chevron-left"></i></a>
            <a href="1">1</a>
            <a href="2">2</a>
            <a href="3">3</a>
            <a href="4">4</a>
            <a href="5">5</a>
            <a href="6"><i class="fas fa-chevron-right"></i></a>
        </div>

</div>

<style>
    header {
        display: none;
    }
</style>