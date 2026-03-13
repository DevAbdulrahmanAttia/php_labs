<?php

spl_autoload_register(function (string $class): void {
    // Split into namespace segments and class name
    $parts     = explode('\\', $class);
    $className = array_pop($parts);
    // Lowercase the namespace segments to match directory names (config, controllers, etc.)
    $directory = strtolower(implode('/', $parts));
    $file      = __DIR__ . '/../' . $directory . '/' . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
