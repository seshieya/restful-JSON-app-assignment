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

use Application\Database\PicturesTable;
use Zend\I18n\Validator\Alpha;

use Application\Model\Pictures;
use Application\Model\Authors;

class PicturesController extends AbstractActionController
{
    private $picturesTable;

    public function __construct()
    {
        $this->picturesTable = new PicturesTable('comp4669assign2', 'root', '');
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function picturesAction()
    {

        $data = [];

        $request = $this->getRequest();
        $start = $request->getQuery('start');
        $count = $request->getQuery('count');

        $allPics = $this->picturesTable->getAllPictures($start, $count);

        $data = $this->buildPictureArrayForJson($allPics);

        return new JsonModel($data);

    }

    public function searchAction()
    {

        $data = [];
        $foundPic = [];

        $request = $this->getRequest();

        /** @var Request $request */
        $searchTerm = $request->getQuery('word');

        $alphaValidator = new Alpha();

        if($alphaValidator->isValid(trim($searchTerm))) {
            $foundPic = $this->picturesTable->getSearchedPicture($searchTerm);
        }

        if($foundPic !== false) {
            $data = $this->buildPictureArrayForJson($foundPic);
        }

        return new JsonModel($data);


    }


    private function buildPictureArrayForJson($data) {

        $pics = [];

        $newPic = new Pictures();
        $newAuthor = new Authors();

        foreach($data as $images) {
            $newPic->init();
            $newAuthor->init();

            $newAuthor->setFullName($images['authors_firstname'], $images['authors_lastname']);

            $newPic->setId($images['pictures_id']);
            $newPic->setTitle($images['pictures_title']);
            $newPic->setDescription($images['pictures_description']);
            $newPic->setFilename($images['pictures_filename']);
            $newPic->setAuthorName($newAuthor);

            $pics[] = $newPic->getPicturesData();

        }

        return $pics;
    }


}
