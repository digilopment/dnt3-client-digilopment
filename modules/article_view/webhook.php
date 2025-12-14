<?php

use DntLibrary\Base\AdminContent;
use DntLibrary\Base\ArticleView;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Settings;

class articleViewModulController
{

    public function run()
    {
        $article = new ArticleView;
        $adminContent = new AdminContent;
        $settings = new Settings;
        $rest = new Rest;

        $id = $rest->webhook(3);

        $show = $adminContent->getPostParam("show", $id);
        if ($show > 0 && $rest->webhook(2) && is_numeric($rest->webhook(3)) && $rest->webhook(4)) {
            $custom_data = array(
                "post_id" => $id,
                "title" => $article->getPostParam("name", $id) . " | " . $settings->get("title"),
                "meta" => array(
                    '<meta name="keywords" content="' . $article->getPostParam("tags", $id) . '" />',
                    '<meta name="description" content="' . $article->getPostParam("name", $id) . '" />',
                    '<meta content="' . $article->getPostParam("name", $id) . '" property="og:title" />',
                    '<meta content="' . SERVER_NAME . '" property="og:site_name" />',
                    '<meta content="article" property="og:type" />',
                    '<meta content="' . $article->getPostImage($id) . '" property="og:image" />',
                ),
            );
            include "tpl.php";
        } else {
            $rest->loadDefault();
        }
    }

}

$modul = new articleViewModulController();
$modul->run();
