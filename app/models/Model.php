<?php
namespace App\Models;

use App\DatabaseService;
use App\Validator;

class Model {
    protected $db;
    protected $validator;
    
    public function __construct() {
        $this->db = DatabaseService::getConnection();
        $this->validator = new Validator();
    }
}
?>