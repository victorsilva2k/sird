<style>
    #documentos_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }
</style>
<div class="btn-groupo">
    <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="btn-groupo__botao center-t btn btn-primary mb-4 ">Publicar Documento</a>
    <a href="" class="btn-groupo__botao center-t btn btn-success mb-4 ">Devolver Documento</a>

    </div>
<div class="paginacao">
    <p class="paginacao__paragrafo">Páginas</p>
    <div class="paginacao__digitos">
        <span class="paginacao__resultados">1-20 de 38</span>
        <div class="paginacao__controles">
            <a href="<?php echo ROOT_URL; ?>postos" class="paginacao__link">
                <svg class="paginacao__icone ">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-chevron-left"></use>
                </svg>
            </a>
            <a href="<?php echo ROOT_URL; ?>postos" class="paginacao__link">
                <svg class="paginacao__icone ">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>
        </div>
    </div>

</div>
<div class="opcoes-documentos">
    <div class="opcoes-documentos__div opcoes-documento__div--activada">
        <a href="" class="opcoes-documentos__link opcoes-documento__link--activado">
            Recebidos
        </a>
    </div>
    <div class="opcoes-documentos__div ">
        <a href="" class="opcoes-documentos__link opcoes-documento__link--desactivado">
            Entregues
        </a>
    </div>
</div>
<table class="tabela tabela-striped">
  <thead>
    <tr>

      <th scope="col">Nome Completo</th>
      <th scope="col">Documentos</th>
      <th scope="col">Data de Publicacação</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Victorino Bimbe Da Silva Kioza</td>
      <td>BI, Carta de Condução</td>
      <td>1 de Janeiro de 2021</td>

    </tr>
    <tr>

      <td >João Bastos de Oliveira</td>
      <td>BI, Recensseamento Militar</td>
      <td>20 de Junho de 2020</td>

    </tr>
    <tr>

      <td>José Morais Dala</td>
      <td>Cartão de Eleitor, NIF</td>
      <td>14 de Dezembro de 2019</td>
    </tr>
    <tr>
      <td>Miguel Januário</td>
      <td>Livrete</td>
      <td>1 de Fevereiro de 2021</td>

    </tr>
    <tr>

      <td >Armando Pedro de Novais</td>
      <td>Recensseamento Militar</td>
      <td>20 de Julho de 2020</td>

    </tr>
    <tr>

      <td>Jovani Kalunga Mateus</td>
      <td>NIF</td>
      <td>14 de Agosto de 2020</td>
    </tr>
    <tr>
      <td>Carla Sachimo Oliveira</td>
      <td>Multicaixa</td>
      <td>2 de Junho de 2020</td>

    </tr>
    <tr>

      <td >Célio da Silva João</td>
      <td>BI, Recensseamento Militar</td>
      <td>20 de Junho de 2020</td>

    </tr>
    <tr>

      <td>José Morais Dala</td>
      <td>Cartão de Eleitor, NIF</td>
      <td>14 de Dezembro de 2019</td>
    </tr>
    
  </tbody>
</table>