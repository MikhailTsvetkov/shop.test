<?php
function env($var, $value=null)
{
    global $_APP_ENV;
    return $_APP_ENV->{$var} ?? $value;
}
