<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

class PrognoseRepository {

  protected $tableName = 'userprognose';

  public function readAllPrognose($id){
    $query = "SELECT m.datum as Datum, t1.Name as Team1, t2.Name as Team2, up.team1_tore as Goals1, up.team2_tore as Goals2
              from userprognose as up
              join matches as m on up.match_id=m.id
              join users as u on u.id=up.user_id
              join teams as t1 on m.team1_id=t1.id
              join teams as t2 on m.team2_id=t2.id
              where u.id =?";

    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('i', $id);

    $statement->execute();

    $result = $statement->get_result();
    if (!$result) {
      throw new Exception($statement->error);
    }

    $rows = array();
    while ($row = $result->fetch_object()) {
        $rows[] = $row;
    }

    return $rows;
  }

  public function savePrognose($userid, $matchid, $Goals1, $Goals2) {
    $query = "INSERT into {$this->tableName} (user_id, match_id, team1_tore, team2_tore) values(?,?,?,?)";

    $statement = ConnectionHandler::getConnection()->prepare($query);

    if (false === $statement) {
        throw new Exception($connection->error);
    }

    $rc = $statement->bind_param('iiii', $userid, $matchid, $Goals1, $Goals2);

    if (false === $rc) {
        throw new Exception($statement->error);
    }
    if (!$statement->execute()) {
        throw new Exception($statement->error);
    }
  }



}
