<?php
namespace Respect\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class UniqueEmailException extends ValidationException {
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is already taken',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is available',
        ],
    ];
}
?>