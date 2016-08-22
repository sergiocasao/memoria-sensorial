<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio | Memoria Sensorial: Ariadna Nolasco</title>
        <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="images/favicon.png">
        <style media="screen">
            html, body{
                margin: 0;
                padding: 0;
                background-color: black;
            }
            #toggle_JS:hover{
                cursor: pointer;
            }
        </style>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    </head>
    <?php
        if(isset($_GET['image']) && !empty($_GET['image']) ):
            $url = 'uploads/'.$_GET['image'];
            // var_dump($_GET);
            // die();
        else:
            $url = 'uploads/macOS.jpg';
        endif;
        if(isset($_GET['ranura']) && !empty($_GET['ranura']) ):
            $ranura = 'images/'.$_GET['ranura'];
            // var_dump($_GET);
            // die();
        else:
            $ranura = 'images/ranura.png';
        endif;
    ?>
    <body>
        <div id="imagen" style="position: fixed; top: 10%; text-align: center;width: 100%;left: 0%;">
            <img src="<?php echo $url; ?>" id="imageUrl_JS" style="height: 600px;" alt="" />
        </div>
        <div class="" id="ranura" style="position: fixed;top: 10%;width: 100%; height: 600px;text-align: center;">
            <div class="" style="width: calc(calc( 100% - 640px)/2); height: 100%; float: left; background-color: black;">

            </div>
            <div class="" style="width: 640px; height: 100%;float: left;background-color: transparent;">
                <img src="<?php echo $ranura; ?>" style="height: 100%;width: 100%;" alt="" />
            </div>
            <div class="" style="width: calc(calc( 100% - 640px)/2); height: 100%; float: left; background-color: black;">

            </div>
        </div>

        <br>

        <span id="toggle_JS" style="display: block;text-align: right;font-size: 12px;margin-bottom: 1em;position: fixed; z-index: 3;top: 1em;left: 1em;color: white;background-color: black;text-decoration: underline;">Mostrar opciones</span>
        <div class="" id="menu_JS" style="position: fixed; z-index: 2; height: 100%;top: 0;padding: 3em 1em;width: 300px;background-color: white;left:-300px;box-sizing: border-box;">
            <h2>Opciones</h2>
            <input type="button" name="name" id="stopper_JS" value="Mover"><br>
            <input type="checkbox" name="vehicle" id="hideGroove" value="1"> Ocultar ranura<br>
            <br>
            <input type="radio" name="type" value="1" checked> Completo<br>
            <input type="radio" name="type" value="2"> Mitad izquierda<br>
            <input type="radio" name="type" value="3"> Mitad derecha<br>
            <br>
            Velocidad: <br>
            <input type="range" name="name" min="10" max="5000" id="velocity" value="1000" style="text-align: right;" oninput="showVelocity()"> <span id="velocityLabel">1000</span> ms <br>
            <br>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Seleccionar imagen de fondo:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Subir imagen" name="submit">
            </form>
        </div>

        <script type="text/javascript">

            var slide_duration = parseInt(1000);
            var opt = 1;
            var stop = true;

            // 1: completo
            // 2: mitad derecha
            // 3: mitad izquierda

            //moverDerecha($('#imagen'));

            function moverDerecha(elem) {
                elem.animate({
                    left: (($('#imageUrl_JS').width()/2) - 85) +"px"
                }, {
                    duration: slide_duration,
                    complete: function() {
                        if (stop) {
                            stopMove();
                        }else {
                            if (opt == 1) {
                                moverIzquierda(elem);
                            }else {
                                moverCentro(elem);
                            }
                        }
                    }
                });
            }

            function moverCentro(elem) {
                elem.animate({
                    left: "0px"
                }, {
                    duration: slide_duration,
                    complete: function() {
                        if (stop) {
                            stopMove();
                        }else {
                            if (opt == 2) {
                                moverDerecha(elem);
                            }else {
                                moverIzquierda(elem);
                            }
                        }
                    }
                });
            }

            function moverIzquierda(elem) {
                elem.animate({
                    left: "-"+ (($('#imageUrl_JS').width()/2) - 85) +"px"
                }, {
                    duration: slide_duration,
                    complete: function() {
                        if (stop) {
                            stopMove();
                        }else {
                            if (opt == 1) {
                                moverDerecha(elem);
                            }else {
                                moverCentro(elem);
                            }
                        }
                    }
                });
            }

            $( "#velocity" ).change(function() {
                slide_duration = parseInt($(this).val());
                console.log('Cambio de velocidad a: '+slide_duration);
            });

            function showVelocity() {
                document.getElementById("velocityLabel").innerHTML = parseInt($( "#velocity" ).val());
            }

            $( "#hideGroove" ).change(function() {
                console.log($(this).is(":checked"));
                if ($(this).is(":checked")) {
                    $('#ranura').hide();
                }else {
                    $('#ranura').show();
                }
            });

            $("input[name=type]:radio").change(function () {
                opt = $('input[name=type]:checked').val();
            });

            $('#toggle_JS').click(function(){
                if (!$('#menu_JS').hasClass('open')) {
                    openMenu();
                }else {
                    closeMenu();
                }
            });

            function openMenu() {
                var toggle = $('#toggle_JS');
                toggle.css('color', '#2B80FF');
                toggle.css('background-color', 'white');
                toggle.text('Ocultar opciones');
                $('#menu_JS').animate({
                    left: "0"
                }, {
                    duration: 300,
                    specialEasing: {
                      width: "linear",
                      height: "easeOutBounce"
                    },
                    complete: function() {
                        $(this).addClass('open');
                        console.log('abierto');
                    }
                });
            }

            function closeMenu() {
                var toggle = $('#toggle_JS');
                toggle.css('color', 'white');
                toggle.css('background-color', 'black');
                toggle.text('Mostrar opciones');
                $('#menu_JS').animate({
                    left: "-"+$(this).width()+"px"
                }, {
                    duration: 300,
                    specialEasing: {
                      width: "linear",
                      height: "easeOutBounce"
                    },
                    complete: function() {
                        console.log('abierto');
                        $(this).removeClass('open');
                    }
                });
            }

            function stopMove() {
                $('#imagen').css('left', 0);
            }

            $('#stopper_JS').click(function() {
                stop = !stop;
                if (stop) {
                    stopMove();
                    $(this).val('Mover');
                }else {
                    $(this).val('Detener');
                    if (opt == 1 || opt == 2) {
                        moverDerecha($('#imagen'));
                    }else{
                        moverIzquierda($('#imagen'));
                    }
                }
            });



        </script>
    </body>
</html>
