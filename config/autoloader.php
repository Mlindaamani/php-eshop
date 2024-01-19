<?php


//This function autoload the classes from the models folder.
spl_autoload_register(fn($class) => require_once __DIR__ . "/../models/{$class}.php");