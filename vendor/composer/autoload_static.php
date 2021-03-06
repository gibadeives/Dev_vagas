<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit365026fbd082d55852eee774e5f0f5db
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit365026fbd082d55852eee774e5f0f5db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit365026fbd082d55852eee774e5f0f5db::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit365026fbd082d55852eee774e5f0f5db::$classMap;

        }, null, ClassLoader::class);
    }
}
