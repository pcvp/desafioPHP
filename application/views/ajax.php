<? include "layout/header.php"; ?>

<div class="row" style="margin-top:2em">
    <div class="col-md-4">

        <h2 id="mensagem"></h2><Br>

        <form method="post" action="<?= base_url() ?>PlanoCartesiano/changePosition">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">X</span>
                </div>
                <input type="text" class="form-control" placeholder="Posição X" name="X" id="X" required aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Y</span>
                </div>
                <input type="text" class="form-control" placeholder="Posição Y" name="Y" id="Y" required aria-describedby="basic-addon1">
            </div>
            <!--<input type="checkbox" name="grafico" id="ChkGrafico"> Exibir gráfico<br><br>-->
            <input type="button" class="form-control margin_10" id="btnChangePosition" value="" />
        </form>
    </div>


    <div class="col-md-8 text-center" id="grafico">
        <canvas id="meuCanvas" height="450" width="450"></canvas>
        <script>
            function atualizarGrafico(x, y) {
                $("#grafico").append('<canvas id="meuCanvas" height="450" width="450"></canvas>');

                fator = 4;
                var canvas = $('#meuCanvas');
                var pincel = canvas.getContext('2d');
                pincel.clearRect(0, 0, canvas.width, canvas.height);




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
                    //pincel.fillStyle = 'black';
                    //pincel.fill();

                    pincel.stroke();
                } else {
                    pincel.font = "16px Arial";
                    pincel.fillText("Uma das coordenadas ficou fora dos limites do gráfico :/", 0, 100);
                    pincel.stroke();
                }
            }
        </script>

    </div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $x = 0;
        $y = 0;
        $("#mensagem").html("Posição inicial");
        $("#btnChangePosition").attr("value", "Iniciar");
        $("#grafico").addClass("invisible");

        /*$("#ChkGrafico").on("click", function() {
            if ($("#ChkGrafico").prop("checked")) {
                $("#grafico").removeClass("invisible");
                atualizarGrafico($x, $y);
            } else {
                $("#grafico").addClass("invisible");
            }
        });*/

        $("#btnChangePosition").on("click", function() {
            $.ajax({
                url: "<?= base_url() ?>/PlanoCartesiano/changePosition",
                type: "POST",
                dataType: "json",
                data: {
                    "X": $("#X").val(),
                    "Y": $("#Y").val()
                },
                success: function(data) {
                    $x = data.x;
                    $y = data.y;
                    $("#mensagem").html("Posição atual é " + $x + "," + $y);
                    /*if ($("#ChkGrafico").prop("checked")) {
                        atualizarGrafico($x, $y);
                    }*/
                },
                error: function(error) {
                    console.log("Error:");
                    console.log(error);
                }
            });

        });

    });
</script>

<? include "layout/footer.php"; ?>