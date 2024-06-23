<?php

namespace Core;

use Exception;
#[\AllowDynamicProperties]
class Env
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!is_file('.env') || !$fp = fopen('.env', "r")) {
            throw new Exception('Не удалось открыть файл .env.');
        }

        while (($buffer = fgets($fp, 4096)) !== false) {
            $buffer = trim($buffer);
            if ($buffer=='' || $buffer[0]=='#') continue;
            $env = explode('=', $buffer, 2);
            switch ($env[1]) {
                case 'true':
                    $env[1] = true;
                    break;
                case 'false':
                    $env[1] = false;
                    break;
                case 'null':
                    $env[1] = null;
                    break;
            }
            $this->{$env[0]} = trim($env[1],'\'"');
        }
        fclose($fp);
    }
}