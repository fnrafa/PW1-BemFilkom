<?php

class Config
{
    private array $vars = [];

    public function __construct()
    {
        $this->loadEnv();
    }

    private function loadEnv(): void
    {
        try {
            $lines = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (str_starts_with($line, '#')) continue;
                list($name, $value) = explode('=', $line, 2);
                $this->vars[$name] = $value;
            }
        } catch (Exception $e) {
            throw new Error($e->getMessage());
        }
    }

    public function get($key)
    {
        return $this->vars[$key] ?? null;
    }
}

function config($key)
{
    static $config = null;
    if ($config === null) {
        $config = new Config();
    }
    return $config->get($key);
}

function generateUUID()
{
    try {
        $data = random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    } catch (Exception $e) {
        throw new Error($e->getMessage());
    }
}

