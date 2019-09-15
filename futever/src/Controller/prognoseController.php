<?php

namespace App\Controller;

use App\View\View;
use App\Repository\Repository;
use App\Repository\UserRepository;
use App\Repository\PrognoseRepository;

class prognoseController {

  public function show() {
    $view = new View('prognose/show');

    $prognoseRepository = new PrognoseRepository();

    $prognosen = $prognoseRepository->readAllPrognose($_SESSION['userID']);

    $view->prognosen = $prognosen;

    $view->display();
  }

  public function createPrognose() {
    $prognoseRepository = new PrognoseRepository();

    $prognoseRepository->savePrognose($_SESSION['userID'], $_POST['mid'], $_POST['toreteam1'], $_POST['toreteam2']);
    header('Location: /prognose/show');
  }

}
