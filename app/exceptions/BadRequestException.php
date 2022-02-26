<?php
namespace App\Exceptions;

use Exception;

class BadRequestException extends Exception {
    private $_errors;

    public function __construct(array $errors) {
        parent::__construct('Bad Request', 0, null);
        $this->_errors = $errors;
    }

    public function getErrors() {
        return $this->_errors;
    }
}
?>