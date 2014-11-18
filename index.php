<?php

$musicfolder = "pifmplay/music/";
$songs = scandir($musicfolder);

?>

<style>
    .bootstrap-switch-container{
        height: 35px;
    }

    html{
        height: 90%;
    }

    body {
        text-align: center;
        min-height: 90%;
    }

    #frequency{
        width: 250px;
        text-align: center;
        font-family: Calibri;
        font-size: 22px;
    }

    .col-centered{
        margin: 0 auto;
        float: none;
    }

    .player {
        font-size: 4em;
    }

    td a {
        font-size: 1.5em;
    }

    .noty_text{
        font-size: 2em;
    }

    .highlight
    {
        background-color:rgb(222, 236, 242);;
    }

</style>


<html>
    <head>
        <!-- bower:css -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" />
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css" />
        <!-- endbower -->
    </head>
        <body>
            <h1>PiFM Music Station</h1>
            <hr/>
            <form method="POST" action="index.php">

                <!-- Frequency input !-->
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 ">
                        <input type="text" class="dial" data-min="88" data-max="108.6" value="88" id="frequency">
                    </div>
                </div>
                <br>

                <!-- On/Off button switch !-->
                <div class="row">
                    <div class="col-lg-12">
                        <input type="checkbox" name="my-checkbox">
                    </div>
                </div>
                <br>

                <div class="row options">
                    <!-- Players button !-->
                    <div class="col-lg-12 player">
                        <i id="play" class="fa fa-play"></i>
                        <i id="pause" class="fa fa-pause"></i>
                        <i id="stop" class="fa fa-stop"></i>
                        <i id="next" class="fa fa-step-forward"></i>
                        <i id="play_all" class="fa fa-play-circle"></i>
                    </div>

                    <!-- Songs !-->
                    <div class="col-lg-12">
                        <div class="bs-example">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Playlist</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                    foreach($songs as $song)
                                    {
                                        echo "<tr>";
                                        if($song != '.' && $song != '..' && $song != '.gitignore') {
                                            echo '<td class="song"><a >' . $song . '</a></td>';
                                        }
                                        echo '</tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

            <!-- bower:js -->
            <script src="bower_components/jquery/dist/jquery.js"></script>
            <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
            <script src="bower_components/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
            <script src="bower_components/noty/js/noty/packaged/jquery.noty.packaged.js"></script>
            <script src="bower_components/jquery-knob/js/jquery.knob.js"></script>
            <!-- endbower -->

            <script>

                // Initialize knob button
                $(".dial").knob({
                    'step':0.1,
                    "skin":"tron",
                    'cursor':true
                });

                $('.options').hide();


                // Bootstrap switch init
                $switch = $("[name='my-checkbox']");

                $('#pause').hide();

                $("[name='my-checkbox']").bootstrapSwitch({
                    size: 'large',
                    offColor: 'danger',
                    onColor: 'success',
                    readonly: false,
                    labelText: 'PiFM'
                });

                // Enable switch button when user typed a frequency
                /*$('#frequency').keyup(function(){
                    if($(this).val() != ''){
                        $("[name='my-checkbox']").bootstrapSwitch('readonly', false);
                    } else {
                        $("[name='my-checkbox']").bootstrapSwitch('readonly', true);
                    }
                });*/

                // Music player events
                $('.fa-step-forward').click(function(event){
                    $.ajax({
                        type:'POST',
                        url: 'actions/next.php',
                        success: function(){
                            noty({
                                text: 'Next track<br><br><br>',
                                layout: 'bottom',
                                timeout: 2500,
                                type:'information'
                            });
                        }
                    });
                });

                $('.fa-stop').click(function(event){
                    $("[name='my-checkbox']").bootstrapSwitch('state', false);
                    noty({
                        text: 'Stop PiFM<br><br><br>',
                        layout: 'bottom',
                        timeout: 2500,
                        type:'information'
                    });
                });


                $('#pause').click(function(event){
                    $.ajax({
                        type:'POST',
                        url: 'actions/pause.php',
                        success: function()
                        {
                            $('#pause').hide();
                            $('#play').show();
                            noty({
                                text: 'Pause<br><br><br>',
                                layout: 'bottom',
                                timeout: 2500,
                                type:'information'
                            });
                        }
                    });
                });

                $('#play').click(function(event){
                    $.ajax({
                        type:'POST',
                        url: 'actions/resume.php',
                        success: function(){
                            $('#play').hide();
                            $('#pause').show();
                            noty({
                                text: 'Resume<br><br><br>',
                                layout: 'bottom',
                                timeout: 2500,
                                type:'information'
                            });
                        }
                    });
                });

                $('#play_all').click(function(event){
                    $.ajax({
                        type:'POST',
                        url: 'actions/start.php',
                        data: 'frequency=' + $('#frequency').val()
                    });
                    noty({
                        text: 'Play all songs<br><br><br>',
                        layout: 'bottom',
                        timeout: 2500,
                        type:'information'
                    });
                });

                $('.song').click(function(event){
                    var song = $(this).text();
                    $.ajax({
                        type:'POST',
                        url: 'actions/play.php',
                        data: 'file=' + song + '&frequency=' + $('#frequency').val()
                    });

                    $('table').find('td.highlight').removeClass('highlight');
                    $(this).addClass('highlight');

                    noty({
                        text: 'Now Playing "'+ song +'"<br><br><br>',
                        layout: 'bottom',
                        timeout: 2500,
                        type:'information'
                    });
                });

                // Bootstrap switch event
                $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
                    console.log(state); // true | false
                    console.log($('#frequency').val());

                    // Make ajax call for switching on and off the radio
                    if(state){
                        $.ajax({
                            type:'POST',
                            url: 'actions/start.php',
                            data: 'frequency=' + $('#frequency').val(),
                            success: function()
                            {
                                $('#play').hide();
                                $('#pause').show();
                            }
                        });
                        $('.options').fadeIn();

                    } else {
                        $.ajax({
                            type:'POST',
                            url: 'actions/stop.php',
                            success: function(){
                                $('#pause').hide();
                                $('#play').show();
                            }
                        });
                        $('.options').fadeOut();
                    }
                });

            </script>

        </body>
    <footer>
    </footer>
</html>








