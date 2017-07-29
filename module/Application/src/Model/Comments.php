<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 02/07/2017
 * Time: 9:00 PM
 */

namespace Application\Model;

class Comments
{
    private $comment;

    public function init() {
        $this->comment = '';
    }

    public function setComment($comment) {
        if(strlen($comment) > 0) {
            $this->comment = $comment;
        }
    }

    public function getComment() {
        return $this->comment;
    }

    public function getCommentData() {
        return [
            'comment' => $this->getComment()
        ];
    }

}