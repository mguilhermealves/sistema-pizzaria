<main class="container-fluid main-section p-0">

    <div class="row">
        <div class="col-12 selfie-pet">
            <div class="row">
                <div class="col-2 p-0 fundo-selfie1">
                    <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/LoversAvertSelfie1.png"); ?>" alt="" />
                </div>

                <div class="col-8 content-header text-center mb-5 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="mb-0">Selfie Pet </h1>
                            <hr>
                            <p><strong>Esse é a timeline SELFIE PET, vote na sua foto preferida
                                        aproveite esse momento para ver esses pets o qual somos 
                                        tão apaixonados.  
                                </strong>
                            </p>

                            <div class="imgPet pb-5">
                                <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/FOTOPET.png"); ?>" alt="" />
                            </div>

                        </div>
                    </div>

                    <div class="row content-selfiepet  mb-5">
                        <div class="col-lg-6 ">
                            <div class="row p-3">
                                <div class="col-lg-12 imagem-nome caixa-sombra ">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2 class="px-3 py-2"><?php printf($data["nome"]) ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <img src="<?php printf("%s%s", constant("cAppRoot"), $data["image"]); ?>" />
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-12 text-center">
                                            <?php if($votado == "true"){ echo '<button class="btn vote votado">VOTADO</button>'; }else{ ?>
                                            <button class="btn vote" id="votar" data-selfiepet="<?php printf($data["slug"]) ?>">VOTAR</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="row p-3">
                                <div class="col-lg-12 caracteristicas caixa-sombra px-4 py-5">
                                     <div class="row">
                                         <div class="col-lg-5"><strong>Nome:</strong></div>
                                         <div class="col-lg-6"><?php printf($data["nome"]) ?></div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-5"><strong>Raça:</strong></div>
                                         <div class="col-lg-6"><?php printf($data["raca"]) ?></div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-5"><strong>Sexo:</strong></div>
                                         <div class="col-lg-6"><?php printf($data["sexo"]) ?></div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-5"><strong>Idade:</strong></div>
                                         <div class="col-lg-6"><?php printf($data["idade"]) ?></div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-5"><strong>Característica:</strong></div>
                                         <div class="col-lg-6"><?php printf($data["caracteristica"]) ?></div>
                                     </div>
                                </div>
                            </div>
                        </div>                         
                    </div>
                </div>

                <div class="col-2 p-0 fundo-selfie2">
                    <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/LoversAvertSelfie2.png"); ?>" alt="" />
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    body {
        overflow-x: hidden;
    }
    .content-selfiepet{
        padding:0 80px;
    }
    #imagePreview img{
        max-width: 100%;
    }
    .selfie-pet p{
        font-size: 32px;
    }
    .caracteristicas,
    .imagem-nome{
        text-align: left;
    }
    .imagem-nome h2{
        color: #464749;
        font-family: "Roboto";
        font-size: 25px;
        font-weight: 700;
        line-height: 30px;
    }
    .caixa-sombra{
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.57);
        background-color: #ffffff;       
        padding: 0;
    }
    .btn.vote{
        color: #ffffff;
        font-family: "Roboto";
        font-size: 22px;
        font-weight: 700;
        border-radius: 3px;
        background-color: #b10000;
        margin:10px auto;
    }
    .btn.vote.votado{
        background-color: #ff390a;
    }
    .btn.vote:hover{
        opacity: 0.6;
    }
    .caracteristicas {
        font-family: "Roboto";
        font-size: 25px;
    }
    .caracteristicas strong{
        color: #464749;
        font-family: "Roboto";
        font-size: 25px;
        font-weight: 700;
    }
    @media (max-width: 414px) {
        .imgDesktop {
            display: none;
        }
       
    }

    @media (min-width: 415px) {
        .imgMobile {
            display: none;
        }
        .imgPet {
            display: none;
        }
    }
</style>

<script>


       

</script>