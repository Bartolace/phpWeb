<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita7f27f788fbb565de8857142af11bf80
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bartolace\\Pdo\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bartolace\\Pdo\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInita7f27f788fbb565de8857142af11bf80::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita7f27f788fbb565de8857142af11bf80::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita7f27f788fbb565de8857142af11bf80::$classMap;

        }, null, ClassLoader::class);
    }
}
