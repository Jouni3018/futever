<?php

namespace App\Controller;

use App\View\View;
use App\Repository\UserRepository;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\PrognoseRepository;

class sessionController
{

    public function login()
    {
      $view = new View("session/login");
      $view->display();
    }
    public function registration()
    {
      $view = new View("session/registration");
      $view->display();
    }
    public function dologout()
    {
      session_destroy();
      header('Location: /session/login');
    }
    public function dologin()
    {
      $userVerifier = new UserRepository();
      $identifier = $_POST['identifier'];
      $password = $_POST['password'];


      if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
          $email = $identifier;

          if ($userVerifier->userExistsByEmail($email)) {
              $currentUserId = $userVerifier->getIDByEmail($email);
              #var_dump($this->currentUserId);
              #var_dump($password);
              #$hash=password_hash("hallo",PASSWORD_DEFAULT);

              #var_dump(password_verify("hallo",$hash));

              if ($userVerifier->verifyPassword($this->currentUserId, $password)) {
                  $_SESSION['logged_in'] = true;
                  $_SESSION['wrongLogin'] = false;
                  $_SESSION['wrongPassword'] = false;
                  $_SESSION['userID'] = $this->currentUserId;
                  $_SESSION['sessionID'] = session_id();
                  $userVerifier->fillInData();
                  #header('Location: /');
              } else {
                  $_SESSION['wrongPassword'] = true;
                #  header('Location: /session/login');
              }
          } else {
              $_SESSION['wrongLogin'] = true;
              header('Location: /session/login');
          }
      } else {
          $username = $identifier;

          if ($userVerifier->userExistsByUsername($username)) {
              $this->currentUserId = $userVerifier->getIDByUsername($username);
              #var_dump($this->currentUserId);
              #var_dump($password);
              #var_dump($userVerifier->verifyPassword($this->currentUserId, $password));

              if ($userVerifier->verifyPassword($this->currentUserId, $password)) {
                  $_SESSION['logged_in'] = true;
                  $_SESSION['wrongLogin'] = false;
                  $_SESSION['wrongPassword'] = false;
                  $_SESSION['userID'] = $this->currentUserId;
                  $_SESSION['sessionID'] = session_id();
                  $userVerifier->fillInData();
                  #echo "klappt";
                  header('Location: /');
              } else {
                  $_SESSION['wrongPassword'] = true;
                  #echo "lol";
                  header('Location: /session/login');
              }
          } else {
              $_SESSION['wrongLogin'] = true;
              header('Location: /session/login');
          }
      }
    }
    public function doregistration()
    {
      $userRepository = new UserRepository();

      if ($_POST['email'] != '' && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['falseEmail'] = true;
        header('Location: /session/registration');
      } elseif ($_POST['email'] != '' && $userRepository->getIDByEmail($_POST['email']) != null) {
          $_SESSION['falseEmail'] = true;
          header('Location: /session/registration');
      }elseif ($_POST['username'] == '') {
            $_SESSION['emptyUsername'] = true;
            header('Location: /session/registration');
      } elseif ($userRepository->getIDByUsername($_POST['username']) != null) {
          $_SESSION['usernameTaken'] = true;
            header('Location: /session/registration');
      } elseif (!isset($_SESSION['falseEmail']) && !isset($_SESSION['usernameTaken'])) {

      $hashedPW = password_hash($_POST['password'], PASSWORD_DEFAULT);
      #var_dump($hashedPW);

      $userRepository->createUser($_POST['username'], $_POST['email'], $hashedPW);

      #$user=$userRepository->readById(8);

      #var_dump($user->Passwort);
      #var_dump($user->Passwort==$hashedPW);
      $_SESSION['userID'] = $userRepository->getIDByUsername($_POST['username']);
      $_SESSION['logged_in'] = true;
      $_SESSION['sessionID'] = session_id();
      $userRepository->fillInData();
      header('Location: /default/index');
      }
    }
    public function admin()
    {
      $teamRepository = new TeamRepository();

      $_SESSION['adminpage']=true;

      $view = new View("admin/creatematches");
      $view->teams = $teamRepository->ReadAll();
      $view->display();
    }
    public function creatematch(){
      $matchRepository=new MatchRepository();
      $teamRepository=new TeamRepository();

      $team1 = $teamRepository->readByName($_POST['team1']);
      $team2 = $teamRepository->readByName($_POST['team2']);

      $matchRepository->create($_POST['datum'], $team1->id, $team2->id,);
      header('Location: /session/admin');

    }
    public function resultateintragen(){
      $matchRepository= new MatchRepository();
      $prognoseRepository=new PrognoseRepository();

      $matchRepository->updateMatch($_POST['toreteam1'],$_POST['toreteam2'],$_POST['mid']);
      header('Location: /');

    }
}
