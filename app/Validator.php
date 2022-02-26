<?php
namespace App;

use Respect\Validation\Validator as v;
use Exception;
use App\Exceptions\BadRequestException;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator {
    private $validators;

    public function __construct() {
        $this->validators = array(
            'id' => v::not(v::nullType())->intVal()->regex('/^[1-9]\d*$/'),
            'firstName' => v::not(v::nullType())->stringType()->notEmpty()->length(2, 35),
            'lastName' => v::not(v::nullType())->stringType()->notEmpty()->length(2, 35),
            'email' => v::when(v::not(v::nullType())->stringType()->notEmpty()->email(), v::uniqueEmail()),
        );
    }

    public function validate($data) {
        try {
            $errors = array();
            foreach ($data as $key => $value) {
                try {
                    if (!array_key_exists($key, $this->validators)) throw new Exception("Validator $key is not defined");
                    $this->validators[$key]->assert($value);
                } catch (NestedValidationException $e) {
                    $errors[$key] = $e->getFullMessage();
                }
            }
            if (count($errors) > 0) throw new BadRequestException($errors);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>