<?php
namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class MatchRepository extends Repository
{
  protected $tableName = 'matches';

  public function create($datum, $team1, $team2){
    $null=0;
    $connection=ConnectionHandler::getConnection();
    $query = "INSERT INTO matches(datum, gespielt, team1_id, team2_id) values (?,?,?,?)";
    $statement = $connection->prepare($query); // can fail because of syntax errors, missing privileges
    if (false === $statement) {
      throw new Exception($connection->error);
    }
    // can fail because the number of parameter doesn't match the placeholders or type conflict
    $rc = $statement->bind_param('siii', $datum, $null, $team1, $team2);
    if (false === $rc) {
      throw new Exception($statement->error);
    }
    if (!$statement->execute()) {
      throw new Exception($statement->error);
    }

  }
  public function ReadAllwithteamName(){
      $eins=1;
      $query= "SELECT m.id, m.datum , m.team1_tore, m.team2_tore, t1.Name as Team1, t2.Name as Team2 FROM {$this->tableName} as m
      join teams as t1 on m.team1_id=t1.id
      join teams as t2 on m.team2_id=t2.id
      where m.gespielt=?
      ORDER BY m.datum asc";

      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i', $eins);
      $statement->execute();

      $result = $statement->get_result();
      if (!$result) {
          throw new Exception($statement->error);
      }

      // Datensätze aus dem Resultat holen und in das Array $rows speichern
      $rows = array();
      while ($row = $result->fetch_object()) {
          $rows[] = $row;
      }

      return $rows;
  }
  public function ReadAllwithteamNameNichtGespielt(){
    $null=0;
      $query= "SELECT m.id, m.datum , m.team1_tore, m.team2_tore, t1.Name as Team1, t2.Name as Team2 FROM {$this->tableName} as m
      join teams as t1 on m.team1_id=t1.id
      join teams as t2 on m.team2_id=t2.id
      where m.gespielt=?
      ORDER BY m.datum asc";

      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i',$null);
      $statement->execute();

      $result = $statement->get_result();
      if (!$result) {
          throw new Exception($statement->error);
      }

      // Datensätze aus dem Resultat holen und in das Array $rows speichern
      $rows = array();
      while ($row = $result->fetch_object()) {
          $rows[] = $row;
      }

      return $rows;
  }
  public function updateMatch($tore1,$tore2,$matchid){
    $eins=1;
    $connection = ConnectionHandler::getConnection();
    $query = "UPDATE matches set team1_tore=?, team2_tore=?, gespielt=? WHERE id=? ";
    $statement = $connection->prepare($query); // can fail because of syntax errors, missing privileges
    if (false === $statement) {
        throw new Exception($connection->error);
    }
    // can fail because the number of parameter doesn't match the placeholders or type conflict
    $rc = $statement->bind_param('iiii', $tore1, $tore2, $eins,$matchid);
    if (false === $rc) {
        throw new Exception($statement->error);
    }
    if (!$statement->execute()) {
        throw new Exception($statement->error);
    }

  }
}
