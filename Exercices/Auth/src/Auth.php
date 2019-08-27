<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 8/22/2019
 * Time: 22:21
 */

namespace App;


class Auth
{

    /** @var \PDO */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login(string $username, string $password): ?User
    {
        $sql = "select * from users where username= :user";
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute(['user' => $username]);
        if (!$res) {
            return null;
        }
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();
        if (!$user) {
            return null;
        }
        if (password_verify($password, $user->password)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $user->id;
            return $user;
        }
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['user'] ?? null;
        if ($id === null) {
            return null;
        }
        $sql = "select * from users where id= :user";
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute(['user' => $id]);
        if (!$res) {
            return null;
        }
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();
        if (!$user) {
            return null;
        }
        return $user;

    }

}