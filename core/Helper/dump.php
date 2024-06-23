<?php

/**
 * @param mixed $object
 *
 * @return void
 */
function dump(mixed $object): void
{
    if (env('XDEBUG')) {
        var_dump($object);
    } else {
        echo '<pre>' . htmlspecialchars(dumperGet($object)) . '</pre>';
    }
}

/**
 * @param mixed $object
 *
 * @return void
 */
function dd(mixed $object): void
{
    dump($object);
    exit();
}

/**
 * @param mixed $object
 * @param string $leftSp
 *
 * @return string
 */
function dumperGet(mixed $object, string $leftSp = ''): string
{
    if (is_array($object)) {
        $type = 'Array[' . count($object) . ']';
    } elseif (is_object($object)) {
        $type = 'Object';
    } elseif (gettype($object) == 'boolean') {
        return $object ? 'true' : 'false';
    } else {
        return '"' . $object . '"';
    }

    $buf = $type;
    $leftSp .= '	';
    foreach ($object as $k => $v) {
        if ($k === 'GLOBALS') {
            continue;
        }
        $buf .= PHP_EOL . $leftSp . $k . ' => ' . dumperGet($v, $leftSp);
    }

    return $buf;
}
