<?php

require_once 'connect.php';
use LDAP\Result;

function select($a, $b, $u0, $u1)
{
    global $pdo;
    $result = new stdClass();
    try {
        $sql = "SELECT * from recur_seq WHERE a=$a AND b=$b AND u0=$u0 AND u1=$u1";
        $statement = $pdo->query($sql);
        $result-> datas = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result-> message = "task done";
    } catch (PDOException $e) {
        $result-> datas = [];
        $result-> message = "task failed";
        die($e->getMessage());
    }
    return $result;
}
