<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2a36f523828d6e7a11db2da76bf1cf3c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit2a36f523828d6e7a11db2da76bf1cf3c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2a36f523828d6e7a11db2da76bf1cf3c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2a36f523828d6e7a11db2da76bf1cf3c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
