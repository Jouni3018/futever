<?php
namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class UserRepository extends Repository
{
  protected $tableName = 'users';

  public function createUser($username,$email,$passwort)
  {
    $connection = ConnectionHandler::getConnection();
    $query = "INSERT INTO users(Benutzername, Mail, Passwort) VALUES(?, ?, ?);";
    $statement = $connection->prepare($query); // can fail because of syntax errors, missing privileges
    if (false === $statement) {
        throw new Exception($connection->error);
    }
    // can fail because the number of parameter doesn't match the placeholders or type conflict
    $rc = $statement->bind_param('sss', $username, $email,$passwort);
    if (false === $rc) {
        throw new Exception($statement->error);
    }
    if (!$statement->execute()) {
        throw new Exception($statement->error);
    }
  }
  public function getIDByEmail($email)
    {
        $users = $this->readAll();
        $userID = null;

        foreach ($users as $user) {
            if ($user->Mail == $email) {
                $userID = $user->id;
                break;
            }
        }
        return $userID;
    }

    public function getIDByUsername($username)
    {
        $users = $this->readAll();
        $userID = null;

        foreach ($users as $user) {
            if ($user->Benutzername == $username) {
                $userID = $user->id;
                break;
            }
        }

        return $userID;
      }
      public function userExistsByUsername($username)
    {
        $users = $this->readAll();
        $userFound = false;

        foreach ($users as $user) {
            if ($user->Benutzername == $username) {
                $userFound = true;
                break;
            }
        }

        return $userFound;
    }

    public function userExistsByEmail($email)
    {
        $users = $this->readAll();
        $userFound = false;

        foreach ($users as $user) {
            if ($user->Mail == $email) {
                $userFound = true;
                break;
            }
        }

        return $userFound;
    }

    public function fillInData()
    {
      $entry = $this->readById($_SESSION['userID']);
      $_SESSION['username'] = $entry->Benutzername;
      $_SESSION['email'] = $entry->Mail;
      $_SESSION['password'] = ($entry->Passwort);
    }
    public function verifyPassword($uid, $password)
    {
        $user = $this->readById($uid);
        #var_dump($user);
        #var_dump(password_verify($password, $user->Passwort));

        #var_dump($password);
        if (password_verify($password, $user->Passwort)) {
            return true;
        } else {
            return false;
        }
    }
}
