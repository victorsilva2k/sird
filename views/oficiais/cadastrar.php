<style>
    .cabecalho--top, .barra-lateral {
        display: none;
    }
</style>

<div class="cont mt-4">
    <div class="login-box">

        <div class="login-box__body center-t">
            
                <form class="formulario w-25" method="POST">
                    <div class="center-t">
                        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="" class="formulario__img">
                    </div>
                    <h1 class="mgb-10 fonte--normal formulario__titulo">Cadastro</h1>
                    <div class="center-t mgb-10">
                        <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="" class="formulario__img--grande bd--grey">
                    </div>

                    <input type="text" name="loginNIP"  class="formulario__input input--text" placeholder="Seu NIP" required
                        autofocus>

                    <input type="text" name="cadastroSobrenome"  class="formulario__input input--text" placeholder="Sobrenome" required>

                    <input type="text" name="cadastroNIP"  class="formulario__input input--text" placeholder="NIP" required>

                    <input type="password" name="cadastroPassword"  class="formulario__input input--text" placeholder="Palavra-passe" required>

                    <input type="password" name="cadastroConfirmarPassword"  class="formulario__input input--text" placeholder="Confirmar Palavra-passe" required>

                    <input type="submit" name="submit" value="Cadastrar" class="formulario__input btn btn-lg btn-primary btn-block">
   

                    <p class="mt-5 mb-3 text--cinza">SIRD &copy; 2017-2019</p>
                </form>
        
        </div>
    </div>
</div>