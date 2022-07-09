<div class="container-fluid h-100">
    <div class="row h-100 align-items-start">
        <form action="<?php print( $GLOBALS["password_url"] )?>" method="POST" class="col-xs-12 col-md-6 col-sm-6 offset-lg-1 col-lg-4 offset-xl-1 col-xl-3 auth-page align-self-center mt-2">
            <div class="auth-form">
                <?php html_notification_print() ?>
                <div class="col-8 mx-auto">
                    <img src="/furniture/images/login/logo.png" class="img-fluid">
                </div>
                <p class="lead">Redefinir a sua Senha! Informe seu CPF e/ou email para enviarmos o processo de renovação de senha.</p>

                <div class="form-body">
                    <div class="pt-3 form-group">
                        <label for="cpf-input">CPF e/ou E-mail:</label>
                        <input type="text" id="cpf-input" name="cpf" class="form-control" autocomplete="off" placeholder="CPF e/ou E-mail">
                    </div>
                    <div class="pt-3 row form-group">
                        <div class="col-12" style="text-align:right">
                            <button type="submit" class="btn btn-success btn-acessar">Reenviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-none d-sm-block col-md-6 col-sm-6 col-lg-7 col-xl-8 h-100 img"></div>
        <div class="d-block d-sm-none col-xs-12 pt-3">
            <img src="/furniture/images/login/produtos.png" class="img-fluid">
        </div>
        <div class="row">
            <div class="col-lg-12 text-center copyright p-3">
                Todos os direitos reservados | 2022 | Desenvolvido por HSOL Marketign de resultados 
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: url(/furniture/images/login/fundo_login.png) repeat-x;
        background-position: top 10px;
        background-size: 100% 80%;
        background-color: #F5F5F5;
    }
    .img{ 
        background: url('/furniture/images/login/img-login.png') center 15px no-repeat transparent;
        background-size: contain;
    }
    .container-fluid.h-100{
        height: calc(100% - 32px) !important;
    }
    
</style>