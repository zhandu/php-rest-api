<?php
namespace App\Controllers;

use stdClass;

class Controller {
    protected $request;

    public function getRequestInputParam($parameter) {
        if (array_key_exists($parameter, $this->request->input)) {
            return $this->request->input[$parameter];
        }
        return null;
    }

    public function __construct() {
        $this->request = new stdClass();
        $this->request->serverParams = $_SERVER;
        $this->request->query = $_GET;
        $this->request->data = $_POST;
        $phpInput = json_decode(file_get_contents("php://input"), true);
        $this->request->input = $phpInput ? $phpInput : array();
    }

    public function sendJSON($data, int $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function sendJSONMessage($msg, int $code = 200) {
        $this->sendJSON(array('message' => $msg), $code);
    }
}
?>