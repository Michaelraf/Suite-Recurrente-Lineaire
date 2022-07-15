<?php
require_once('./database/insert.php');
require_once('./database/select.php');

use function PHPSTORM_META\type;

// Response parameter
$response = new stdClass();
http_response_code(200);
header('Content-Type: application/json; charset=utf-8');

// Verify if values are already in the database
$same = select($_POST["a"], $_POST["b"], $_POST["u0"], $_POST["u1"]);
if (sizeof($same->datas) != 0) {
    $datas = $same->datas[0];
    $response->value = $datas['value'];
    $response->message = "found in the database";
} 
else {
    $operation = "tex1(solve_rec(u(n+2)=" . $_POST["a"] . "*u(n+1)+" . $_POST["b"] . "*u(n),u(n),u(0)=" . $_POST["u0"] . ",u(1)=" . $_POST["u1"] . "));";
    $option = "display2d: false;";
    $command = "maxima --very-quiet -r \"load(\"solve_rec\");" . $option . $operation . " quit();\"";
    $value = "";
    exec($command, $result, $result_code);
    for ($i = 6; $i < sizeof($result) - 1; $i++) {
        $value .= $result[$i];
    }
    $value = str_replace('"', '', $value);
    $value = str_replace("\\\\", "\\", $value);
    $value = str_replace("u\\left(n\\right)", "U_n", $value);
    $response->value = $value;
    $response->message = "found by resolution";

    // insert values to the database
    insert($_POST["a"],$_POST["b"], $_POST["u0"], $_POST["u1"], $value);
}

echo (json_encode($response));
