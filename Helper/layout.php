<?php
function layout(string $name, array $_VARS=[]): void
{
    extract($_VARS);
    include 'View' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $name . '.php';
}
