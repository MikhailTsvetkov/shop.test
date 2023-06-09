<?php

function dump($obj): void
{
    echo
    "<pre>",
    htmlspecialchars(dumperGet($obj)),
    "</pre>";
}

function dumperGet(&$obj, $leftSp = ""): string
{
    if (is_array($obj)) {
        $type = "Array[".count($obj)."]";
    } elseif (is_object($obj)) {
        $type = "Object";
    } elseif (gettype($obj) == "boolean") {
        return $obj? "true" : "false";
    } else {
        return "\"$obj\"";
    }
    $buf = $type;
    $leftSp .= "	";
    foreach ($obj as $k=>$v) {
        if ($k === "GLOBALS") continue;
        $buf .= "\n$leftSp$k => ".dumperGet($v, $leftSp);
    }
    return $buf;
}

function dd($obj)
{
    dump($obj);
    exit();
}
