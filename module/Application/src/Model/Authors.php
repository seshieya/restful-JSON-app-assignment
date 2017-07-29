<?php
/**
 * Created by PhpStorm.
 * User: ANGELA
 * Date: 02/07/2017
 * Revised: 09/July/2017
 * Time: 9:05 PM
 */

namespace Application\Model;


class Authors
{
    private $fullName;

    public function init() {
        $this->fullName = '';
    }

    public function setFullName($firstname, $lastname) {
        $this->fullName = ucwords($firstname . ' ' . $lastname);
    }

    public function getFullName() {
        return $this->fullName;
    }
}