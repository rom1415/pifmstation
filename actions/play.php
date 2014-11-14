<?php

// Play a specific file with pifmplay
if(isset($_POST['file']) && isset($_POST['frequency']))
{
    // Stop pifm first
    echo shell_exec('sudo sh ../pifmplay/pifmplay stop');
    echo shell_exec('sudo sh ../pifmplay/pifmplay "../pifmplay/music/'.$_POST['file'].'" '.$_POST['frequency'].'  ');
}
