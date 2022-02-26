<?php
namespace App\Controllers;

use App\Models\UserModel;
use Exception;
use App\Exceptions\BadRequestException;

class UserController extends Controller {
    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function add() {
        try {
            $status = $this->userModel->add(
                $this->getRequestInputParam('firstName'),
                $this->getRequestInputParam('lastName'),
                $this->getRequestInputParam('email'),
            );
            if ($status) {
                $this->sendJSONMessage('User added successfully', 201);
            } else throw new Exception();
        } catch (BadRequestException $e) {
            $this->sendJSON($e->getErrors(), 400);
        } catch (Exception $e) {
            $this->sendJSONMessage('An error occurred while adding user', 500);
        }
    }

    public function getAll() {
        try {
            $users = $this->userModel->getAll();
            $this->sendJSON($users);
        } catch (Exception $e) {
            $this->sendJSONMessage('An error occurred while getting users', 500);
        }
    }

    public function get($id) {
        try {
            $user = $this->userModel->get($id);
            if ($user !== false) $this->sendJSON($user);
            else $this->sendJSONMessage('User not found', 404);
        } catch (BadRequestException $e) {
            $this->sendJSON($e->getErrors(), 400);
        } catch (Exception $e) {
            $this->sendJSONMessage('An error occurred while getting user', 500);
        }
    }

    public function delete($id) {
        try {
            $status = $this->userModel->delete($id);
            if ($status) $this->sendJSONMessage('User deleted successfully');
            else throw new Exception();
        } catch (BadRequestException $e) {
            $this->sendJSON($e->getErrors(), 400);
        } catch (Exception $e) {
            $this->sendJSONMessage('An error occurred while deleting user', 500);
        }
    }
}
?>