<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./assets/scripts/load-mathjax.js" defer></script>
    <script src="./assets/scripts/script.js" defer></script>
    <link rel="stylesheet" href="./assets/styles/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <title>Suite récurrente d'ordre 2 - Résolution</title>
</head>

<body class="vh-100">
    <header class="bg-primary mb-3">

    </header>
    <div class="main mt-3 pt-3 pb-3 w-100 fs-4 d-flex flex-column justify-content-center align-items-center">
        <div class="intro ps-5 mb-5 w-100">
            <p>Suite recurrente d'ordre 2</p>
            <div class="definition fs-6">
                <p> Une suite $U_n$ est une suite récurrente linéaire d'ordre 2 s'il existe deux nombres a et b tels que, pour tout entier n, on a </p>
                <p>
                    $
                    U_{n+2} = a*U_{n+1} + b*U_n
                    $
                </p>
                <p>sachant la valeur de $U_0$ et de $U_1$</p>
            </div>
        </div>
        <div class="coontainer w-50">
            <div class="input-container m-auto">
                <div class="e1">
                    $
                    U_{n+2} =
                    $
                    <input class="coeff" type="text" id="a">
                    $
                    U_{n+1} +
                    $
                    <input class="coeff" type="text" id="b">
                    $
                    U_n
                    $
                </div>
                <div class="e2">
                    $
                    U_0 =
                    $
                    <input type="text" class="coeff" id="u0">
                </div>
                <div class="e3">
                    $
                    U_1 =
                    $
                    <input type="text" class="coeff" id="u1">
                </div>
            </div>
            <div class="input m-2">
                <div class="btn-container w-100 d-flex flex-row justify-content-center">
                    <button class="mt-3 mb-2 btn btn-primary btn-md w-25" id="submit">Résoudre</button>
                </div>
            </div>
        </div>
        <div id="error" class="fs-5 fst-italic"></div>
        <div id="result" class="m-4"></div>
    </div>
    </div>
</body>

</html>