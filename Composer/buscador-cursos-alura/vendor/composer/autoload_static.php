<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a5a002b192704c99a43f3f4c41a21ba
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Gabrielbartolace\\BuscadorCursos\\' => 32,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Gabrielbartolace\\BuscadorCursos\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a5a002b192704c99a43f3f4c41a21ba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a5a002b192704c99a43f3f4c41a21ba::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4a5a002b192704c99a43f3f4c41a21ba::$classMap;

        }, null, ClassLoader::class);
    }
}
