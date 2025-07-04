<?php

// Lokasi: application/third_party/Midtrans/Midtrans.php

/**
 * Midtrans Library
 *
 * This file is the main autoloader for the Midtrans PHP library.
 * It's responsible for loading all other necessary files.
 */
class Midtrans
{
    /**
     * Autoload function for Midtrans classes.
     *
     * @param string $class The name of the class to load.
     */
    public static function autoload($class)
    {
        if (strpos($class, 'Midtrans') === 0) {
            $class = str_replace('Midtrans\\', '', $class);
            $file = dirname(__FILE__) . '/' . str_replace('\\', '/', $class) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    /**
     * Register the autoloader.
     */
    public static function register()
    {
        spl_autoload_register(array('Midtrans', 'autoload'));
    }
}

// Register the autoloader immediately when this file is included.
Midtrans::register();