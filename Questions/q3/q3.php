<?php

function renameImages($directionPath) {
    $i = 1; 
    if ($handle = opendir($directionPath)) { 
        while (false !== ($file = readdir($handle))) { 
            if ($file != "." && $file != ".." && is_file($directionPath.'/'.$file)) { 
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $newName = $directionPath.'/'.$i.'.'.$extension;
                rename($directionPath.'/'.$file, $newName);
                $i++; 
            }
        }
        closedir($handle);
    }
}

$directionPath = 'images';
renameImages($directionPath);
