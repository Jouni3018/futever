<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd895b4f1478aef708f7ecdc5f35f4a48
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd895b4f1478aef708f7ecdc5f35f4a48::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd895b4f1478aef708f7ecdc5f35f4a48::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
