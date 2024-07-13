<?php

namespace App\Helpers;

class CommonHelper {
    /**
     * get fullname
     * @param string $firstName
     * @param string $lastName
     */
    static function getFullName($firstName, $lastName, $title = null) {
        $fullName = $firstName .' '.$lastName;
        if(!is_null($title)) $fullName = $title.' '.$fullName;
        return $fullName;
    }
}
