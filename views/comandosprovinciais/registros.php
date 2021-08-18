<style>
    .comando-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<?php foreach($viewmodel['comando_provincial'] as $item) : extract($item);?>
    <div class="bairros content-div br-25 mgb-20">
        <div class="content-div__cima">

            <h1 class="titulo--normal content-div__titulo">Comando Provincial de <?php echo $nome_cp?></h1>
        </div>



        <div class="content-div__baixo">
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p >Comando Provincial de <?php echo $nome_cp?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Província</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $provincia?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Endereço</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo "$municipio, $distrito, $bairro, $rua"?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Terminal</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $terminal?></p></div>
            </div>

        </div>



    </div>
    <a href="<?php echo ROOT_URL; ?>comandosprovinciais/editar/<?php echo $id_cp?>" class="mgb-20 center-t btn btn-success mb-4 ">Editar</a>

<?php endforeach;?>
<!-- Registros -->


<?php if(Controller::verificarLugar(4)): ?>


    <a href="<?php echo ROOT_URL; ?>comandonacional/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>

    <div class="alteracoes-documento registro-alteracoes">
        <h1 class="titulo--normal">Registro de Alterações</h1>

        <table class="tabela tabela-striped">
            <thead>
            <tr>

                <th scope="col">Agente</th>
                <th scope="col">Acção</th>
                <th scope="col">Data</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($viewmodel["alteracoes"] as $item) : extract($item);?>

                <tr>

                    <td><?php echo "$nome $sobrenome"?></td>
                    <td><?php
                        if ($tipo == 1) {
                            $tipo_extenso = "Criado";
                        }
                        elseif ($tipo == 2) {
                            $tipo_extenso = "Editado";
                        }
                        elseif ($tipo == 3) {
                            $tipo_extenso = "Eliminado";
                        }

                        echo "$tipo_extenso";
                        ?>

                    </td>
                    <td><?php echo $this->tratarData($data, true)?></td>

                </tr>

            <?php endforeach;?>

            </tbody>
        </table>
    </div>
<?php endif;?>