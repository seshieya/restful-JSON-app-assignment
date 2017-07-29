<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 28/06/2017
 * Time: 10:35 PM
 */

namespace Application\Database;

class CommentsTable extends BaseTable
{
    public function getComments($id) {
        $select = $this->sql
            ->select()
            ->columns(['comments_comment'])
            ->from('comments')
            ->join(
                'pictures',
                'comments.pictures_id = pictures.pictures_id',
                [],
                'right'
            )
            ->where('pictures.pictures_id = ' . $id );

        $query = $this->sql->buildSqlString($select);

        return $this->adapter->query($query)->execute();
    }
}