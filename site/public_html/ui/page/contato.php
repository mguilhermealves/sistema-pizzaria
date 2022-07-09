<main class="container">
   <div class="row my-3 mx-3">
      <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
         <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
      </div>

      <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
         <div class="row">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Contato</div>
         </div>

         <div class="row pt-4 form-contato">
            <div class="col-12 card py-4 px-4">
                <form action="<?php print( $GLOBALS["contato_url"] ) ?>" method="POST" class="col-lg-12">
                <?php html_notification_print() ?>
                    
                Em caso de dúvidas, entre em contato com a administração da campanha utilizando um dos canais disponíveis ou preenchendo este formulário.<br><br>
                        <strong>• E-mail: contato@endamaissanther.com.br</strong><br>
                        <strong>• Central de atendimento:  </strong><br>
                        <br>
                    <div class="row">
                        <div class="form-group py-2 col-lg-12">
                            <label for="name-input">Nome</label>
                            <input type="text" name="name" id="name-input" class="form-control letra" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group py-2 col-lg-4">
                            <label for="telephone-input">Telefone</label>
                            <input type="text" name="telephone" id="telephone-input" class="form-control letra">
                        </div>
                        <div class="form-group py-2 col-lg-8 padding-left-20 xs-padding-left-0">
                            <label for="email-input">E-mail</label>
                            <input type="email" name="email" id="email-input" class="form-control letra">
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="form-group py-2 col-lg-12">
                            <label for="message-input">Sua mensagem</label>
                            <textarea name="message" id="message-input" class="form-control text letra"></textarea>
                        </div>
                    </div>
                    
                        <div class="row padding-top-10 botao">
                            <div class="col-lg-12">
                                <button name="btn_save" type="submit" class="btn btn-secondary btn-acessar" style="width: 30%; height: 3rem; border-radius: 10px;">Enviar</button>
                            </div>                        
                        </div>
                </form>
            </div>
        </div>

      </div>
    </div>
</main>

