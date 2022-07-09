<main class="container">
   <div class="row my-3 mx-3">
      <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
         <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
      </div>

      <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
         <div class="row">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Extrato de PONTOS</div>
         </div>

               <div class="row mt-4 quizz-list">
                  <div class="col-lg-12 card py-4 px-4">

                  <div class="row padding-bottom-20 title-page">
                     <div class="col-lg-12">
                        <h2>Extrato de Pontos</h2>
                        <h3>Veja sua pontuação acumulada na campanha.</h3>
                     </div>
                  </div>


                    <div class="period">
                        <div class="input-group">
                            <label class="input-group-text" for="period-input">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M880 184H712v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H384v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H144c-17.7 0-32 14.3-32 32v664c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V216c0-17.7-14.3-32-32-32zm-40 656H184V460h656v380zM184 392V256h128v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h256v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h128v136H184z"></path>
                                </svg>
                                Selecione o mês
                            </label>
                            <select class="form-select" id="period-input">
                                <?php foreach(  $GLOBALS["month_name"] as $k => $v ){ ?>
                                <option <?php print( $k == date("m") ? ' selected' : '' ) ?> value="<?php print( $k ) ?>"><?php print( $v ) ?>/2022</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

            <div class="row">
                <div class="col-12 col-md-12">
                    <?php foreach( $GLOBALS["month_name"] as $x => $r ){ ?>
                    <table id="tbl_extrato<?php print( $x ) ?>" class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <!-- th>Tipo</th-->
                                <th>Descrição</th>
                                <th>Pontos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if( isset( $array[$x] ) ){
                                    foreach ($array[$x]["data"] as $l => $m) {
                                        foreach ($m["infos"] as $k => $n) {
                                            print('<tr class="tbl' . $m["mes"] . '">');
                                            //print('<td>' . ( isset( $m["tipo"] ) ? $m["tipo"] : "" )  . '</td>');
                                            print('<td>' . ( isset( $n["name"] ) ? $n["name"] : "" )  . '</td>');
                                            print('<td>' . ( isset( $n["points"] ) ? $n["points"] : "" )  . '</td>');
                                            print('</tr>');
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
                  </div>
                </div>
      </div>
    </div>
</main>


<style>
    .results .extra-rules {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 10%;
    }
</style>