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

