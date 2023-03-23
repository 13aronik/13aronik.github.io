<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\News;

$app->get("/admin/news", function(){


    User::verifyLogin();

    $news = News::listAll();

    $page = new PageAdmin();

    $page->setTpl("news", [
        "news"=>$news
    ]);

});

$app->get("/admin/news/create", function(){


    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("news-create");

});

$app->post("/admin/news/create", function(){


    User::verifyLogin();

        $news = new News();

        $news->setData($_POST);

        $news->save();

        header("Location: /admin/news");
        exit;

});

$app->get("/admin/news/:news_id", function($news_id){

    User::verifyLogin();
 
    $news = new News();

    $news->get((int)$news_id); 

    $page = new PageAdmin();

    $page->setTpl("news-update", [
        'news'=>$news->getValues()
    ]);

});

$app->post("/admin/news/:news_id", function($news_id){

    User::verifyLogin();
 
    $news = new News();

    $news->get((int)$news_id); 

    $news->setData($_POST);

    $news->save();

    $news->setPhoto($_FILES["file"]);

    header('Location: /admin/news');
    exit;

});

$app->get("/admin/news/:news_id/delete", function($news_id){

    User::verifyLogin();
 
    $news = new News();

    $news->get((int)$news_id); 

    $news->delete();

    header('Location: /admin/news');
    exit;
    });


?>