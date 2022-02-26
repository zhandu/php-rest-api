<?php
namespace Respect\Validation\Rules;

use App\DatabaseService;
use Exception;

class UniqueEmail extends AbstractRule {
    protected $db;

    public function __construct() {
        $this->db = DatabaseService::getConnection();
    }

    public function validate($email): bool {
        try {
            $query = "SELECT COUNT(*) as 'nb' FROM `users` WHERE `email` = ?";
            $sth = $this->db->prepare($query);
            $sth->execute([$email]);
            $nbEmails = $sth->fetch()->nb;
            return $nbEmails === 0;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>