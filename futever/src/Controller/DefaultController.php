<?php

namespace App\Controller;

use App\View\View;
use App\Repository\Repository;
use App\Repository\UserRepository;
use App\Repository\TeamRepository;

use App\Repository\MatchRepository;

/**
 * Der Controller ist der Ort an dem es für jede Seite, welche der Benutzer
 * anfordern kann eine Methode gibt, welche die dazugehörende Businesslogik
 * beherbergt.
 *
 * Welche Controller und Funktionen muss ich erstellen?
 *   Es macht sinn, zusammengehörende Funktionen (z.B: User anzeigen, erstellen,
 *   bearbeiten & löschen) gemeinsam in einem passend benannten Controller (z.B:
 *   UserController) zu implementieren. Nicht zusammengehörende Features sollten
 *   jeweils auf unterschiedliche Controller aufgeteilt werden.
 *
 * Was passiert in einer Controllerfunktion?
 *   Die Anforderungen an die einzelnen Funktionen sind sehr unterschiedlich.
 *   Folgend die gängigsten:
 *     - Dafür sorgen, dass dem Benutzer eine View (HTML, CSS & JavaScript)
 *         gesendet wird.
 *     - Daten von einem Model (Verbindungsstück zur Datenbank) anfordern und
 *         der View übergeben, damit diese Daten dann für den Benutzer in HTML
 *         Code umgewandelt werden können.
 *     - Daten welche z.B. von einem Formular kommen validieren und dem Model
 *         übergeben, damit sie in der Datenbank persistiert werden können.
 */
class DefaultController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://my-project.local/). Weshalb das so ist, ist und wann
     * welcher Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public function index()
    {
      $matchRepository=new MatchRepository();
      $teamRepository=new TeamRepository();

      $_SESSION['adminpage']=false;
      if ($_SESSION['logged_in']) {
        $view = new View("default/index");
        $view->matchesGespielt = $matchRepository->ReadAllwithteamName();
        $view->matchesNichtGespielt = $matchRepository->ReadAllwithteamNameNichtGespielt();
        $userRepository = new UserRepository();
        $user = $userRepository->readById($_SESSION['userID']);
        $iconsmall = $this->get_gravatar($user->Mail);
        $iconbig = $this->get_gravatar($user->Mail, '200');
        $view->iconbig = $iconbig;
        $view->iconsmall = $iconsmall;
        $view->user = $user;
        $view->display();
      }
      else {
        $view = new View("session/login");
        $view->display();
      }
    }

    /**
    * Get either a Gravatar URL or complete image tag for a specified email address.
    *
    * @param string $email The email address
    * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
    * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
    * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
    * @param boole $img True to return a complete IMG tag False for just the URL
    * @param array $atts Optional, additional key/value attributes to include in the IMG tag
    * @return String containing either just a URL or a complete image tag
    * @source https://gravatar.com/site/implement/images/php/
    */
    public function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
      $url = 'https://www.gravatar.com/avatar/';
      $url .= md5( strtolower( trim( $email ) ) );
      $url .= "?s=$s&d=$d&r=$r";
      if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
        $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
      }
      return $url;
    }
}
