<?php

class View
{
    private mixed $baseDir;

    public function __construct($baseDir = __DIR__ . "/../View")
    {
        $this->setBaseDir($baseDir);
    }

    public function setBaseDir(mixed $baseDir): void
    {
        $this->baseDir = $baseDir;
    }

    public function getBaseDir()
    {
        return $this->baseDir;
    }
}

function loadView($viewName, $data = null): void
{
    $view = new View();
    $path = $view->getBaseDir() . '/' . str_replace('.', '/', $viewName) . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            extract($data);
        } elseif (!is_null($data)) {
            $data = $data;
        }
        require $path;
        exit();
    } else {
        $data = [
            'errorMessage' => "404 Not Found"
        ];
        loadView('Error.error', $data);
    }
}

function viewRoute($routeName): void
{
    $path = str_replace('.', '/', $routeName);
    header("Location: $path");
}
