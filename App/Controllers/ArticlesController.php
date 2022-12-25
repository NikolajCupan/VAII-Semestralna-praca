<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Article;

class ArticlesController extends AControllerBase
{
    public function index() : Response
    {
        $data = Article::getAll();
        return $this->html($data);
    }
}