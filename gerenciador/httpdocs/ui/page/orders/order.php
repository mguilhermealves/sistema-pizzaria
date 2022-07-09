<section class="content-header">
    <h1>
        <?php print(constant("cTitle")) ?>
        <small><?php print($form["title"]) ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?php print($GLOBALS["orders_url"]) ?>"><?php print($pages); ?> </a></li>
        <li class="active"><?php print($page); ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="container-fluid">
            <div class="box-body">
                <?php switch ($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["slug"]) {
                    case "administrador":
                    case "financeiro":
                    case "master":
                        if (!isset($info["idx"])) {
                            // Pré Pedido:
                            include(constant("cRootServer") . "ui/page/orders/forms/create.php");
                        } else {
                            switch ($data["orderstatus_attach"][0]["idx"]) {
                                case "1":
                                    include(constant("cRootServer") . "ui/page/orders/forms/edit.php");

                                    break;
                            }
                        }
                        break;
                } ?>
            </div>
        </div>
    </div>