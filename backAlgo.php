<?php

use function PHPSTORM_META\type;

$response = new stdClass();
http_response_code(200);
header('Content-Type: application/json; charset=utf-8');
if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
        $response->$key = $value;
    }
}

// Résolution de l'équation caractéristique
$option = "display2d: false; load(\"to_poly_solve\"); ";
$operation = "to_poly_solve([r^2-" . $_POST["a"] . "*r-" . $_POST["b"] . "=0], [r]);";
$command = "maxima --very-quiet -r \"" . $option . $operation . " quit();\"";
$value = "";
exec($command, $result, $result_code);
for ($i = 6; $i < sizeof($result) - 1; $i++) {
    $value .= $result[$i];
}
$value = substr(str_replace("%union", "", $value), 1, -1);
$rawRoots = explode(",", $value);
$roots = [];
foreach ($rawRoots as $key => $val) {
    array_push($roots, trim(substr($val, 4, -1)));
}
$response->roots = $roots;
$un = "";

// Gestion des variables contenant les racine
if (sizeof($roots) === 1) {
    $r1 = $roots[0];
    $r2 = $roots[0];
} elseif (sizeof($roots) === 0) {
    $r1 = null;
    $r2 = null;
} else {
    $r1 = $roots[0];
    $r2 = $roots[1];
}

if ($r1 != null && !str_contains($r1, "%i")) {
    $option = "display2d: false; ";
    $operation = "solve([u*".$r1."^0+v*".$r2."^0+=" . $_POST["u0"] . ", u*".$r1."^1+v*".$r2."^1+=" . $_POST["u1"] . "], [u,v]);";
    $command = "maxima --very-quiet -r \"" . $option . $operation . " quit();\"";
}
elseif(str_contains($r1 != null && $r1, "%i")){
    
    $option = "display2d: false; ";
    $operation = "solve([u*".$r1."^0+v*".$r2."^0+=" . $_POST["u0"] . ", u*".$r1."^1+v*".$r2."^1+=" . $_POST["u1"] . "], [u,v]);";
    $command = "maxima --very-quiet -r \"" . $option . $operation . " quit();\"";
}



// $option = "display2d: false; ";
// $operation = "solve([u+v=" . $_POST["u0"] . ", " . $roots[0] . "*u+" . $roots[0] . "*v=" . $_POST["u1"] . "], [u,v]);";
// $command = "maxima --very-quiet -r \"" . $option . $operation . " quit();\"";
// exec($command, $result, $result_code);
// $uv = $result[12];


$response->result = $result;
$response->r1 = $r1;
$response->r2 = $r2;

echo (json_encode($response));
