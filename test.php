<?php

use Controllers\TestController;
use Controllers\Admin\CacheSetAdminController;

require_once 'lib/common.inc.php';


$ctrl = new TestController();

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = '';
}

switch($action){
    case 'newLayout':
        $ctrl->newLayout();
        break;
    default:
        $ctrl->index();
}


exit(0);

