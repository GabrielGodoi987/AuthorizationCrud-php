<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a36f523828d6e7a11db2da76bf1cf3c
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Token\\App\\' => 10,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Token\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a36f523828d6e7a11db2da76bf1cf3c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a36f523828d6e7a11db2da76bf1cf3c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2a36f523828d6e7a11db2da76bf1cf3c::$classMap;

        }, null, ClassLoader::class);
    }
}