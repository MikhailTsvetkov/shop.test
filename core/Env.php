<?php

namespace Core;

use Exception;

class Env
{
    private array $environment = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!is_file('.env') || !$fp = fopen('.env', 'r')) {
            throw new Exception('Failed to open file .env');
        }

        while (($buffer = fgets($fp, 4096)) !== false) {
            $buffer = trim($buffer);
            if ($buffer == '' || $buffer[0] == '#') {
                continue;
            }

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

            $this->environment[$env[0]] = trim($env[1], '\'"');
        }

        fclose($fp);
    }

    /**
     * @param string $name
     *
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get(string $name, mixed $default = null): mixed
    {
        if (array_key_exists($name, $this->environment)) {
            return $this->environment[$name];
        } else {
            return $default;
        }
    }
}
