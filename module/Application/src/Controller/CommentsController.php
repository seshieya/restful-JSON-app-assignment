<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;
use Zend\Http\Request;

use Application\Database\CommentsTable;

use Application\Model\Comments;

class CommentsController extends AbstractActionController
{
    private $commentsTable;

    public function __construct()
    {
        $this->commentsTable = new CommentsTable('comp4669assign2', 'root', '');
    }

    public function commentsAction()
    {
        $data = [];

        /** @var Request $request */
        $request = $this->getRequest();
        $pictureId = $request->getQuery('pictures_id');

        $comments = $this->commentsTable->getComments($pictureId);

        $newComment = new Comments();

        foreach($comments as $comment) {

            $newComment->init();

            if($comment['comments_comment'] != null) {
                $newComment->setComment($comment['comments_comment']);
                $data['comments'][] = $newComment->getCommentData();
            }
        }

        return new JsonModel($data);
    }


}
