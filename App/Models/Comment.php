<?php

namespace App\Models;

use App\Core\Model;

class Comment extends Model
{
    protected $id;
    protected $article;
    protected $user;
    protected $text;
    protected $date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article): void
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getAuthorName()
    {
        $user = User::getOne($this->getUser());

        if (isset($user))
        {
            return $user->getUsername();
        }
        else
        {
            return "[unknown]";
        }
    }

    public function getAbbreviatedAuthorName()
    {
        $name = $this->getAuthorName();

        if (strlen($name) <= 15)
        {
            return $name;
        }
        else
        {
            return substr($name, 0, 15) . "...";
        }
    }
}