<?php

/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */
session_start();

if (!isset($_SESSION['logged_in'])) {
  $_SESSION['logged_in'] = false;
}

require_once __DIR__.'/../vendor/autoload.php';

use App\Dispatcher\Dispatcher;

Dispatcher::dispatch();

?>
