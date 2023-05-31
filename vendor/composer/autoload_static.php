<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d50e8fad79123bc9f78f6e91f2f36d6
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leticia\\FilmesTarefa\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leticia\\FilmesTarefa\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d50e8fad79123bc9f78f6e91f2f36d6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d50e8fad79123bc9f78f6e91f2f36d6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d50e8fad79123bc9f78f6e91f2f36d6::$classMap;

        }, null, ClassLoader::class);
    }
}
