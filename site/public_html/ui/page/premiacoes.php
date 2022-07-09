
<main class="container">
    <div class="row my-3 mx-3">
        <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
            <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
        </div>

        <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
            <div class="row">
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Premiações</div>
            </div>

            <div class="row pt-4">
                <div class="col-12 card py-4 px-4">

                <div class="row padding-bottom-20 title-page">
                     <div class="col-lg-12">
                        <h2>Portal de prêmios</h2>
                        <h3>Troque aqui seus pontos acumulados por diversos prêmios!</h3>
                     </div>
                  </div>


                    <img src="<?php printf("%s%s", constant("cFurniture"), "images/img_destaque_1.png"); ?>" class="img-fluid pb-3" alt="" />    
                    <br/>   <br/>               
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at justo sed ante interdum vestibulum. Pellentesque ligula nisl, convallis a laoreet vel, faucibus non libero. Duis quis mollis magna, blandit fermentum justo. Pellentesque ut facilisis leo. Curabitur pharetra arcu feugiat neque fermentum, nec sollicitudin nibh sagittis. Integer nulla dolor, congue nec pulvinar vel, tincidunt sed enim. Nullam sit amet orci vel dui eleifend pulvinar. Vestibulum auctor, lectus facilisis dapibus luctus, ligula velit pulvinar orci, ac tempus nunc arcu congue quam. Sed elementum sed dui at scelerisque. Donec sagittis ac enim hendrerit luctus.
                    </p>

                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <?php if( !empty( $link_btn ) ){  ?>                       
                                <a id="botao-entrar" href="<?php print( $link_btn )?>" class="btn btn-primary mb-3 botao-entrar-portal">ACESSAR PORTAL</a>                      
                            <?php } ?>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</main>