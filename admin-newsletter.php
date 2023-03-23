<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\News;
use \Hcode\Model\subscribe;


$app->get("/admin/newsletter", function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("newsletter");

});



?>