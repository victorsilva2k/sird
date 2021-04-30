<style>
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }
</style>
    
    <div class="btn-groupo">
    <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="btn-groupo__botao center-t btn btn-primary mb-4 ">Publicar Documento</a>
    <a href="<?php echo ROOT_URL; ?>documentos/devolver" class="btn-groupo__botao center-t btn btn-success mb-4 ">Devolver Documento</a>

    </div>
    <div class="visao-geral mgt-20">
        <div class="visao-geral__total-doc visao-geral__div br-25">
            <h1 class="visao-geral__titulo">156</h1>
            <p class="visao-geral__texto-normal">Total Documentos</p>
        </div>
        <div class="visao-geral__doc-retido visao-geral__div br-25">
            <h1 class="visao-geral__titulo">81</h1>
            <p class="visao-geral__texto-normal">Documentos Retidos</p>
        </div>
        <div class="visao-geral__doc-devolvido visao-geral__div br-25">
            <h1 class="visao-geral__titulo">81</h1>
            <p class="visao-geral__texto-normal">Documentos Devolvidos</p>
        </div>

    </div>
    <div class="documentos-recentes">
    
        <h1 class="titulo--normal">Documentos Recebidos</h1>
    
        <table class="tabela tabela-striped">
            <thead>
                <tr>

                <th scope="col">Nome Completo</th>
                <th scope="col">Documentos</th>
                <th scope="col">Data de Publicação</th>
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
                
            </tbody>
        </table>
    </div>