<?php

require_once 'connect.php';

function insert($a, $b, $u0, $u1, $value)
{
    global $pdo;
    $sql = 'INSERT INTO recur_seq VALUES(:a, :b, :u0, :u1, :value)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':a' => $a,
        ':b' => $b,
        ':u0'=> $u0,
        ':u1'=> $u1,
        ':value' => $value
    ]);
}
