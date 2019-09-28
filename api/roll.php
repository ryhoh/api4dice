<?php

header('Content-Type: text/html; charset=UTF-8');

// パラメータに問題があり，サイコロを振らずに終了する
function fault() {
    $res = [
        'status' => 'fault',
    ];
    print json_encode($res, JSON_PRETTY_PRINT);
    exit();
}

// サイコロを振って終了
function roll($name, $value) {
    $rolled_val = rand(1, $value);

    $res = [
        'status' => 'success',
        'name' => $name,
        'value' => $rolled_val,
    ];
    print json_encode($res, JSON_PRETTY_PRINT);
    exit();
}


// main
// POSTメソッドを想定
if (isset($_POST["name"]) and isset($_POST["type"])) {
    $name = htmlspecialchars($_POST["name"]);
    $type = htmlspecialchars($_POST["type"]);

    if ($name === '') {
        fault();
    }

    if (preg_match("/1d(4|6|8|10|100)/", $type)) {
        roll($name, intval(substr($type, 2)));
    } else {
        fault();
    }
} else {
    fault();
}
