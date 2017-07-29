<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 28/06/2017
 * Time: 10:35 PM
 */

namespace Application\Database;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class BaseTable
{
    protected $adapter;
    protected $sql;

    public function __construct($database, $username, $password) {
        $this->adapter = new Adapter([
            'driver'    => 'Pdo_Mysql',
            'hostname'  => '127.0.0.1',
            'database'  => $database,
            'username'  => $username,
            'password'  => $password
        ]);

        $this->sql = new Sql($this->adapter);
    }



}