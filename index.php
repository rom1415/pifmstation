<?php

$musicfolder = "pifmplay/music/";
$songs = scandir($musicfolder);

?>

<html>
    <head>

        <!-- Custom style !-->
        <link rel="stylesheet" href="css/style.css"></link>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
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
                <div class="row knob-section">
                    <div class="col-lg-12 col-sm-12 col-xs-12 ">
                        <input type="text" class="dial" data-min="88" data-max="108.6" value="88" id="frequency">
                        <div class="mhz">88.0 Mhz</div>
                    </div>
                </div>
                <br>

                <!-- On/Off button switch !-->
                <div class="row switch">
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
                            <table id="playlist" class="table table-hover">
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

            <!-- Custom script !-->
            <script src="javascript/core.js"></script>

        </body>
    <footer>
    </footer>
</html>








