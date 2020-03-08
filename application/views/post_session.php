<? include "layout/header.php"; ?>

<div class="row" style="margin-top:2em">
    <div class="col-md-4">
        <? if (isset($x)) { ?>
            <h2><?= "Posição atual é $x,$y" ?></h2>
        <? } else { ?>
            <h2>Posição inicial</h2>
        <? } ?><Br>
        <form method="post" action="<?= base_url() ?>PlanoCartesiano/changePosition">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">X</span>
                </div>
                <input type="text" class="form-control" placeholder="Posição X" name="X" required aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Y</span>
                </div>
                <input type="text" class="form-control" placeholder="Posição Y" name="Y" required aria-describedby="basic-addon1">
            </div>
            <input type="checkbox" name="grafico" <?= isset($_POST['grafico']) ? "checked" : "" ?>> Exibir gráfico<br><br>
            <input type="submit" class="form-control margin_10" value="<?= $TextButton ?>" />
        </form>
    </div>

    <?php if (isset($_POST["grafico"])) { ?>

        <div class="col-md-8 text-center">
            <canvas id="meuCanvas" height="450" width="450"></canvas>
            <script>
                fator = 4
                x = <?= $x ?>;
                y = <?= $y ?>;


                var canvas = document.getElementById('meuCanvas');
                var pincel = canvas.getContext('2d');



                if ((x <= 50) && (y <= 50)) {


                    x = x * fator;
                    y = y * fator;



                    //INICIO X Y
                    pincel.moveTo(canvas.width / 2, 0);
                    //FINAL X Y
                    pincel.lineTo(canvas.width / 2, canvas.height);
                    pincel.stroke();

                    //INICIO X Y
                    pincel.moveTo(0, canvas.height / 2);
                    //FINAL X Y
                    pincel.lineTo(canvas.width, canvas.height / 2);
                    pincel.stroke();


                    pincel.font = "10px Arial";
                    pincel.fillText("50", (canvas.width / 2) + 5, 27);
                    pincel.fillText("50", (canvas.width / 2) + 5, canvas.height - 20);

                    pincel.fillText("50", canvas.width - 30, (canvas.height / 2) + 15);
                    pincel.fillText("50", 20, (canvas.height / 2) + 15);


                    var centerX = canvas.width / 2 + x;
                    var centerY = canvas.height / 2 - y;


                    var radius = 3;

                    pincel.beginPath();
                    pincel.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
                    pincel.fillStyle = 'black';
                    pincel.fill();

                    pincel.stroke();
                } else {
                    pincel.font = "16px Arial";
                    pincel.fillText("Uma das coordenadas ficou fora dos limites do gráfico :/", 0, 100);
                    pincel.stroke();
                }
            </script>

        </div>

    <? } ?>
</div>

<? include "layout/footer.php";
