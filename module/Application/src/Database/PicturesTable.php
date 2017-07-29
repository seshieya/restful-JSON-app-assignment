<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 28/06/2017
 * Revised 09/July/2017
 */

namespace Application\Database;

use Zend\Db\Sql\Where;

class PicturesTable extends BaseTable
{
    public function getAllPictures($start, $count)
    {
        $offset = 0;
        $limit = 0;

        if (!isset($start) && !isset($count)) {
            $offset = 0;
            $limit = 8;
        } else {
            $offset = $start;
            $limit = $count;
        }

        $select = $this->sql
            ->select()
            ->columns(['pictures_id', 'pictures_title', 'pictures_description', 'pictures_filename'])
            ->from('pictures')
            ->join(
                'authors',
                'pictures.authors_id = authors.authors_id',
                ['authors_firstname', 'authors_lastname'],
                'left'
            )
            ->limit($limit)
            ->offset($offset);


        $query = $this->sql->buildSqlString($select);

        return $this->adapter->query($query)->execute();
    }

    public function getSearchedPicture($searchTerm) {
        $picExists = false;

        $where = new Where();
        $where->like('pictures_title', '%' . $searchTerm . '%');

        $select = $this->sql
            ->select()
            ->columns(['pictures_id', 'pictures_title', 'pictures_description', 'pictures_filename'])
            ->from('pictures')
            ->join(
                'authors',
                'pictures.authors_id = authors.authors_id',
                ['authors_firstname', 'authors_lastname'],
                'left'
            )
            ->where($where);

        $query = $this->sql->buildSqlString($select);

        $results = $this->adapter->query($query)->execute();

        if(sizeof($results) == 0) {
            $picExists = false;
        }
        else {
            $picExists = $results;
        }

        return $picExists;
    }
}