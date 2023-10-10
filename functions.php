<?php

if(!session_id()) {
    session_start();
}

foreach (["/admin_helpers","/endpoints"] as $directory_url) {
    if(is_dir(dirname(__FILE__).$directory_url)) {
        $helpers_dir = new DirectoryIterator(dirname(__FILE__).$directory_url);
        foreach ($helpers_dir as $file) {
            if (!$file->isDot() && !$file->isDir()) {
    
                include $file->getRealPath();
            }
        }
    }
}
$utility_functions = [];
$util_iter = new DirectoryIterator(dirname(__FILE__)."/utility_functions");
foreach ($util_iter as $file) {
    if(!$file->isDot() && !$file->isDir()) {
        include $file->getRealPath(); 
        $fn = explode(".",$file->getFilename())[0];
        $utility_functions[$fn] = ${$fn};
    }
}
$components = []; 
$component_iter = new DirectoryIterator(dirname(__FILE__)."/components");
foreach($component_iter as $file) {
    if(!$file->isDot() && !$file->isDir()) {
        include $file->getRealPath(); 
        $fn = explode(".",$file->getFilename())[0];
        $components[$fn] = ${$fn};
    }
}

?>