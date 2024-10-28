<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9dc1ee356eed6a31f67c48bd974b46e
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
            'Interuniversalbuddy\\AmuriqiM295\\' => 32,
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
        'Interuniversalbuddy\\AmuriqiM295\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9dc1ee356eed6a31f67c48bd974b46e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9dc1ee356eed6a31f67c48bd974b46e::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb9dc1ee356eed6a31f67c48bd974b46e::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitb9dc1ee356eed6a31f67c48bd974b46e::$classMap;

        }, null, ClassLoader::class);
    }
}