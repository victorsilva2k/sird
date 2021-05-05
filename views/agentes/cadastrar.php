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
            
                <form class="formulario w-25" method="POST" enctype="multipart/form-data">
                    <div class="center-t">
                        <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="" class="formulario__img ">
                    </div>
                    <h1 class="mgb-10 fonte--normal formulario__titulo">Cadastro</h1>
                    <label for="filetype" class="botao cancel">
                    <div class="center-t mgb-10">
                        <img src="<?php echo ROOT_IMG; ?>site/usuario.png" alt="" class="formulario__img--grande bd--grey preview-img img--perfil">
                    </div>
                    
                        
                    </label>
                    <input id="filetype" type="file" name="cadastroFoto" class="file-chooser" hidden />
                    <input type="text" name="cadastroNome"  class="formulario__input input--text" placeholder="Nome" minlength="2" maxlength="100" required
                        autofocus>

                    <input type="text" name="cadastroSobrenome" maxlength="100" class="formulario__input input--text" placeholder="Sobrenome" minlength="2" required>
                    
                    <label for=""  class="formulario__label">Genero</label>

                    <select class="formulario__input input--text" name="cadastroGenero" id="">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                    <label for="" class="formulario__label">Data de nascimento</label>
                    <input  type="date" class="formulario__input input--text" id="date-input" name="cadastroDataNascimento" />

                    <input type="number" name="cadastroNIP"  class="formulario__input input--text" placeholder="NIP" minlength="6" maxlength="7" required>

                    <input type="password" minlength="12" name="cadastroPassword" maxlength="200"  class="formulario__input input--text" placeholder="Palavra-passe" required>
                    

                    <input type="password" minlength="12" name="cadastroConfirmarPassword" maxlength="200" class="formulario__input input--text" placeholder="Confirmar Palavra-passe" required>

                    <input type="submit" name="submit" value="Cadastrar" class="formulario__input btn btn-lg btn-primary btn-block">
                    <a href="<?php echo ROOT_URL ?>agentes/entrar" class="link formulario__link mgb-10">Já tem conta? Iniciar Sessão</a>
                    


                    <p class="mt-5 mb-3 text--cinza">SIRD &copy; 2021</p>
                </form>
                <script>
                        const $a = document.querySelector.bind(document);
                        const previewImg = $a('.preview-img');
                        const fileChooser = $a('.file-chooser');

                        fileChooser.onchange = e => {
                            const fileToUpload = e.target.files.item(0);
                            const reader = new FileReader();

                            // evento disparado quando o reader terminar de ler 
                            reader.onload = e => previewImg.src = e.target.result;

                            // solicita ao reader que leia o arquivo 
                            // transformando-o para DataURL. 
                            // Isso disparará o evento reader.onload.
                            reader.readAsDataURL(fileToUpload);
                        };
                </script>
        </div>
    </div>
</div>