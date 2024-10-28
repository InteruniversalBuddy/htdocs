<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite374169d03488a437c66dce2ff402312
{
    public static $prefixLengthsPsr4 = array (
        'l' => 
        array (
            'lib\\' => 4,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'I' => 
        array (
            'Interuniversalbuddy\\Tag5\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Interuniversalbuddy\\Tag5\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Steampixel' => 
            array (
                0 => __DIR__ . '/..' . '/steampixel/simple-php-router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite374169d03488a437c66dce2ff402312::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite374169d03488a437c66dce2ff402312::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite374169d03488a437c66dce2ff402312::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite374169d03488a437c66dce2ff402312::$classMap;

        }, null, ClassLoader::class);
    }
}