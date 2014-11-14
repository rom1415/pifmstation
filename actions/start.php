<?php

if(isset($_POST['frequency']))
{
    // Stop pifm first
    echo shell_exec('sudo sh ../pifmplay/pifmplay stop');

    // Execute pifmplay on the music folder with a custom frequency
    echo shell_exec('sudo sh ../pifmplay/pifmplay "../pifmplay/music" ' . $_POST['frequency'] . ' &');
}