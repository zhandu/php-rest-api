<?php
namespace App\Models;

class UserModel extends Model {
    public function add($firstName, $lastName, $email) {
        $this->validator->validate(array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
        ));
        $query = "INSERT INTO `users`(`firstName`, `lastName`, `email`) VALUES(?, ?, ?)";
        $sth = $this->db->prepare($query);
        $sth->execute([$firstName, $lastName, $email]);
        if ($sth->rowCount() === 1) return true;
        return false;
    }

    public function getAll() {
        $query = "SELECT `id`, `firstName`, `lastName`, `email` FROM `users`";
        $sth = $this->db->prepare($query);
        $sth->execute([]);
        return $sth->fetchAll();
    }

    public function get($id) {
        $this->validator->validate(array(
            'id' => $id
        ));
        $query = "SELECT `id`, `firstName`, `lastName`, `email` FROM `users` WHERE `id` = ?";
        $sth = $this->db->prepare($query);
        $sth->execute([$id]);
        return $sth->fetch();
    }

    public function delete($id) {
        $this->validator->validate(array(
            'id' => $id
        ));
        $query = "DELETE FROM `users` WHERE `id` = ?";
        $sth = $this->db->prepare($query);
        $sth->execute([$id]);
        if ($sth->rowCount() === 1) return true;
        return false;
    }
}
?>