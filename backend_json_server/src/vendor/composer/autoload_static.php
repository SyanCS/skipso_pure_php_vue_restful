<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit09361cd0bb9ba6c927aa337ffc06b6b7
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'skipso\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'skipso\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit09361cd0bb9ba6c927aa337ffc06b6b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit09361cd0bb9ba6c927aa337ffc06b6b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit09361cd0bb9ba6c927aa337ffc06b6b7::$classMap;

        }, null, ClassLoader::class);
    }
}
