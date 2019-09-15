<?php
namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class TeamRepository extends Repository
{
  protected $tableName = 'teams';

  public function readByName($name){
    $query = "SELECT * FROM {$this->tableName} WHERE name =?";

    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('s', $name);
    $statement->execute();

    $result = $statement->get_result();
    if (!$result) {
        throw new Exception($statement->error);
    }

    // Ersten Datensatz aus dem Reultat holen
    $row = $result->fetch_object();

    // Datenbankressourcen wieder freigeben
    $result->close();

    // Den gefundenen Datensatz zurückgeben
    return $row;
  }
}
