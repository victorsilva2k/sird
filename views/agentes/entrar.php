<style>
    .cabecalho--top, .barra-lateral {
        display: none;
    }
    .principal {
     margin-left: auto; 
     margin-top: 0; 
    }
</style>

<div class="cont mt-4">
    <div class="login-box">

        <div class="login-box__body center-t">
            
                <form class="formulario w-25" method="POST">
                    <div class="center-t">
                        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="" class="formulario__img">
                    </div>
                    <h1 class="mgb-10 fonte--normal formulario__titulo">Iniciar Sessão</h1>
                    
                    <input type="number" name="loginNIP"  class="formulario__input input--text" placeholder="Seu NIP" minlength="6" maxlength="7" required
                        autofocus>

                    <input type="password" name="loginPassword"  class="formulario__input input--text" placeholder="Password" required>

                    <input type="submit" name="submit" value="Entrar" class="formulario__input btn btn-lg btn-primary btn-block">

                    <a href="<?php echo ROOT_URL ?>agentes/cadastrar" class="link formulario__link mgb-10">Criar conta</a>
                    <a href="<?php echo ROOT_URL ?>agentes/entrar" class="link formulario__link mgb-10">Esqueceu a palavra-passe? </a>

                    <p class="mt-5 mb-3 text--cinza">SIRD &copy; 2021</p>
                </form>
        
        </div>
    </div>
</div>