<div class="card mb-2">
    <img class="w-100" src="<?php printf("%s%s", constant("cFurniture"), "images/img_marca.png"); ?>" alt="" style="max-height: 300px;" />
    <div class="text-center py-3 px-2">
        <img class="rounded-circle w-50" src="<?php printf("%s%s", constant("cFurniture"), "images/img_marca.png"); ?>" alt="" />
        <br>
        <a href="<?php print( $GLOBALS["mydata_url"] ) ?>" class="link-primary-profile">Editar Perfil</a>

        <div class="card-info py-3 mt-3">
            Bem Vindo<br><strong><?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"] . " " . $_SESSION[constant("cAppKey")]["credential"]["last_name"]) ?></strong>
        </div>
        <div class="card-info py-1 mt-2">
            <bold><?php print( isset( $_SESSION[constant("cAppKey")]["credential"]["rkn"] ) ? $_SESSION[constant("cAppKey")]["credential"]["rkn"] . "&ordm; lugar" : "-" ) ?></bold>
        </div>
        <div class="card-info py-2 mt-2">
            <bold><?php print( isset( $_SESSION[constant("cAppKey")]["credential"]["goal_total"] ) ? sprintf("%02d Ponto%s" , $_SESSION[constant("cAppKey")]["credential"]["goal_total"] , $_SESSION[constant("cAppKey")]["credential"]["goal_total"] > 1 ? "s" : "" ) : "" ) ?></bold>
        </div>
        <a href="<?php print( $GLOBALS["logout_url"] ) ?>" class="link-sair">SAIR</a>

    </div>
</div>

<div class="card pb-3">
    <div class="text-center pb-0 px-2">
        <div class="card-info py-2 mt-3" style="border-radius: 10px 10px 0px 0px;color:#000;">
            Canal WhatsApp da campanha
        </div>
        <div class="whatsapp-card">
            (11) 90000-0000
        </div>
    </div>
</div>

<style>
    .card{
        background: #FFFFFF;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
    }
    .whatsapp-card {
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 0px 0px 10px 10px;
        font-size: 1rem;
    }
    .link-primary-profile{
        font-family:'Roboto';
        font-weight:300;
        font-size:0.75rem;
        line-height:0.879rem;
        text-align:center;
        text-decoration:none;
        color:#000;
    }
    .card-info{
        border: 1px solid #D9D9D9;
        border-radius:10px;
        font-family:'Roboto';
        font-weight:300;
        font-size:1.025rem;
        line-height:1.218rem;
        text-align:center;
        color:#2F017B;
    }
    .card-info strong{
        font-family:'Roboto';
        font-weight:500;
        font-size:1.3rem;
        line-height:1.558rem;
        text-align:center;
        color:#2F017B;
    }
    .card-info bold{
        font-family:'Roboto';
        font-weight:500;
        font-size:1.125rem;
        line-height:1.313rem;
        text-align:center;
        color:#2F017B;
    }
    .link-sair{
        font-family:'Roboto';
        font-weight:500;
        font-size:0.75rem;
        line-height:0.87rem;
        text-align:center;
        color:#DC3545;
        text-decoration:none;
    }
    
</style>