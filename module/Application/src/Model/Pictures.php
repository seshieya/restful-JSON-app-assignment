<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 02/07/2017
 * Time: 9:00 PM
 */

namespace Application\Model;

class Pictures
{
    private $id;
    private $title;
    private $description;
    private $filename;
    private $authorName;

    public function init() {
        $this->id = 0;
        $this->title = '';
        $this->description = '';
        $this->filename = '';
        $this->authorName = '';
    }

    public function setId($id) {
        if($id > 0) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setTitle($title) {
        if(strlen($title) > 0) {
            $this->title = $title;
        }
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        if(strlen($description) > 0) {
            $this->description = $description;
        }
    }

    public function getDescription() {
        return $this->description;
    }

    public function setFilename($filename) {
        if(strlen($filename) > 0) {
            $this->filename = $filename;
        }
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setAuthorName(Authors $author) {
        $this->authorName = $author->getFullName();
    }

    public function getAuthorName() {
        return $this->authorName;
    }

    public function getPicturesData() {
        return [
            'id' => $this->getId(),
            'authorName' => $this->getAuthorName(),
            'pictureTitle' => $this->getTitle(),
            'pictureDescription' => $this->getDescription(),
            'filename' => $this->getFilename()
        ];
    }

}