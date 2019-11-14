<?php include 'Loteria.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Loteria Monetizze</title>
    </head>
    <body>
        <h2>Loteria</h2>
        <form action="index.php" method="post">
            <table>
                <tr> 
                    <td align="right">Quantidade de Dezenas:</td>
                    <td><input type="number" name=qtde_dezenas value=<?php echo $_POST["qtde_dezenas"] ?>></td>
                </tr>
                <tr> 
                    <td align="right">Total de Jogos:</td>
                    <td><input type="number" name=total_jogos value=<?php echo $_POST["total_jogos"] ?>></td>
                </tr>
                <tr> 
                    <td></td>
                    <td align="right"><input type=submit value="Realizar Sorteio"></td>
                </tr>
                 
                 
            </table>

        </form>

        <?php
        $qtde_dezenas = (int) $_POST["qtde_dezenas"];
        $total_jogos = (int) $_POST["total_jogos"];

        if(!$qtde_dezenas && !$total_jogos){
            echo "Digite a quantidade de dezenas e o número total de jogos no formulário acima.";
            return;
        }
        if ($qtde_dezenas < 6 || $qtde_dezenas > 10)
        {
            echo "<br>Quantidade de dezenas inválida. <br> Digite uma das opções: 6, 7, 8, 9, ou 10.";
            return;
        }

        $lot = new Loteria($qtde_dezenas, $total_jogos);

        $resultado_final = $lot->executaLoteria();

        ?>

        <h2>Resultado da Loteria</h2>

        <h4>Dezenas sorteadas: </h4> 
        <?php
        for ($i = 0; $i < 6; $i++)
        {
            if ($i < 5)
            {
                echo $lot->getResultado()[$i] . " - ";
            }
            else
            {
                echo $lot->getResultado()[$i];
            }
        }
        ?>
        <h4>Resultado dos Jogos: </h4> 

        <table border=3px>
            <tr>
                <td width="90" align='center'># Jogo</td>

                <td width="50" align='center' colspan="<?php echo $lot->getQuantidadeDeDezenas(); ?>">Dezenas do Jogo</td>

                <td width="80" align='center' border="5px"> # Acertos</td>
            </tr>


        <?php for ($i = 0; $i < $lot->getTotalDeJogos(); $i++) { ?>
                <tr>
                    <td width="90" align='left'>Jogo <?php echo $i + 1 ?></td>
                    <?php for ($j = 0; $j < $lot->getQuantidadeDeDezenas(); $j++) { ?>
                        <td width="50" align='center'><?php echo $lot->getJogos()[$i][$j]; ?></td>
                    <?php } ?>
                    <td width="80" align='center' bgcolor="#8EE5EE" border="5px"> <?php echo $resultado_final[$i]; ?> </td>
                </tr>
        <?php } ?>
        </table>

    </body>
</html>
