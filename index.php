<?php

 namespace Monetizze;
 use Monetizze\Loteria; 

 //Caso solicitado um valor via formulário
 if(!empty($_POST)){
   
    require("Loteria.php");

    $novosJogos = new Loteria($_POST['jogos'], $_POST['dezenas']); //define quantidades de dezenas e de jogos
    $resultadoSorteio = $novosJogos->realizarSorteio();

}

?>

<!DOCTYPE html>
    <head>
        <title>LOTERIA MONETIZZE</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
         <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container">
        <?php if(!empty($_POST)){ ?>
            <div class="row">
                <div class="col-sm">
                    <div>
                       <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="6">Dezenas Sorteadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!--Recebe o valor do jogo sorteado -->
                                    <?php foreach($novosJogos->getFinal() as $key => $resultadoFinal){ ?> 
                                        <td class="table-warning"><?php echo $resultadoFinal; ?></td>
                                    <?php }?>
                                </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <?php foreach($novosJogos->getJogos() as $key => $jogo){ ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="<?php echo $novosJogos->getDezenas();?>">Aposta nº <?php echo $key+1;?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach($jogo as $valor){ ?> 
                                        <td class="<?php echo ($novosJogos->numeroSorteado($valor, $key, $resultadoSorteio)) ? "table-primary" : "" ?>"><?php echo $valor; ?></td>
                                    <?php }?>
                                </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <?php }?>
                    </div> 
                </div>
            </div>
        <?php }else{?>
                    <div class="row justify-content-center align-items-center">
                        <form method="post" action="index.php">
                            <h3> Selecione a quantidade de Jogos e Dezenas a serem sorteadas </h3>    
                            <div class="form-group">
                                <label for="inputState"> Jogos</label>
                                <select id="inputState" name="jogos" class="form-control">
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Dezenas</label>
                                <select id="inputState" name="dezenas" class="form-control">
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Sortear</button>
                        </form>
                    </div>
        <?php } ?>
        </div> 
    
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
</html>