<?php

spl_autoload_register('getclass');

function getclass($classes) {
    // Use an absolute path to locate the classes folder
    $first = __DIR__ . '/../classes/';
    $second = '.class.php';
    $combined = $first . $classes . $second;

    if (file_exists($combined)) {
        include_once($combined);
    } else {
        throw new Exception("Class file for {$classes} not found at {$combined}");
    }
}