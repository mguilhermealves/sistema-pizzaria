<main class="main-section">
    <div class="points-statement-page">
        <div class="container">
            <div class="content-header d-flex justify-content-center mb-3 mt-5">
                <h1 class="mb-0">Ranking | Trimestral</h1>
            </div>
            <hr>
            
            <div class="col-12 col-lg-6 mx-auto period">
                <div class="input-group">
                    <label class="input-group-text" for="period-input">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M880 184H712v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H384v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H144c-17.7 0-32 14.3-32 32v664c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V216c0-17.7-14.3-32-32-32zm-40 656H184V460h656v380zM184 392V256h128v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h256v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h128v136H184z"></path>
                        </svg>
                        Selecione o Trimestre
                    </label>
                    <select class="form-select" id="period-input">
                        <?php
                        switch (date("m")) {
                            case "01":
                            case "02":
                            case "03":
                                $y = 1;
                                break;
                            case "04":
                            case "05":
                            case "06":
                                $y = 2;
                                break;
                            case "07":
                            case "08":
                            case "09":
                                $y = 3;
                                break;
                            case "10":
                            case "11":
                            case "12":
                                $y = 4;
                                break;
                        }
                        foreach ($select as $k => $v) {
                        ?>
                        <option <?php print($k == $y  ? ' selected' : '') ?> value="<?php print($k) ?>"><?php print($v) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="dataTable">
                        <div class="columns">
                            <div class="column" style="max-width: 100px;"><button>Colocação</button></div>
                            <div class="column" style="max-width: 100%;"><button>Nome</button></div>
                            <div class="column" style="max-width: 100px;"><button>Pontos</button></div>
                        </div>
                        <?php
                        foreach (array_keys($GLOBALS["periodos"]) as $k) {
                            foreach ($GLOBALS["rkn" . $k][1] as $v) {
                        ?>
                            <div class="tbl<?php print($k) ?> columns" style="<?php print($v["idx"] == $_SESSION[constant("cAppKey")]["credential"]["idx"] ? 'border: 3px solid #0000ff;' : '') ?>">
                                <div class="column" style="max-width: 100px;"><button><?php print($GLOBALS["rkn" . $k][0][$v["total"] ] + 1) ?></button></div>
                                <div class="column" style="max-width: 100%;"><?php print($v["first_name"] . " " . $v["last_name"]) ?></div>
                                <div class="column" style="max-width: 100px;"><?php 
                                $p = explode("." , $v["total"] );
                                $p[1] = isset( $p[1] ) ? substr( $p[1] , 0 , 2 ) : "00" ;
                                print( $p[0] .".". $p[1] ); ?></div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>