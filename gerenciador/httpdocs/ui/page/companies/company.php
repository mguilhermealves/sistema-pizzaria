<section class="content-header">
    <h1>
        <?php print(constant("cTitle")) ?>
        <small><?php print($form["title"]) ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active"><a href="<?php print($GLOBALS["companies_url"]) ?>">Empresas </a></li>
    </ol>
</section>

<section class="content">
    <div class="row">

        <div class="container-fluid">
            <div class="box-body">

                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <!-- TABS -->
                    <?php include(constant("cRootServer") . "ui/page/companies/components/tabs.php"); ?>
                    
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .autocomplete-suggestions {
        overflow: auto;
        background-color: #fff;
        border: 1px solid #c0c0c0
    }

    .autocomplete-suggestion {
        background-color: #fff;
        clear: both;
        cursor: pointer;
        display: block;
        font-size: 0.9rem;
        padding: 0.5rem;
    }

    .autocomplete-suggestion p {
        vertical-align: middle;
        padding-top: 15px;
        color: #0A4C80;
        font-size: 1.5rem
    }

    .autocomplete-selected {
        background-color: #0A4C80;
        color: #fff;
    }

    .autocomplete-selected p {
        color: #fff !important;
        font-size: 0.9rem
    }
</style>