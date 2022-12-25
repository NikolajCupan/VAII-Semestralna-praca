<?php

namespace App\Models;

use App\Core\Model;
use App\Models\Like;
use App\Models\User;

class Article extends Model
{
    protected $id;
    protected $author;
    protected $title;
    protected $text;
    protected $image;
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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
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
        $user = User::getOne($this->getAuthor());

        if (isset($user))
        {
            return $user->getUsername();
        }
        else
        {
            return "Unknown";
        }
    }

    public function getAbbreviatedText()
    {
        $text = $this->getText();

        if (strlen($text) <= 300)
        {
            return $text;
        }
        else
        {
            return substr($text, 0, 300) . "...";
        }
    }

    public function getLikesCount()
    {
        $likes = Like::getAll('article = ?', [$this->getID()]);

        if (isset($likes))
        {
            return count($likes);
        }
        else
        {
            return 0;
        }
    }

    public function hasLikeFromUser($userId) : bool
    {
        if (!isset($userId))
        {
            return false;
        }

        $like = Like::getAll('user = ? and article = ?', [$userId, $this->id]);


        if (count($like) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}