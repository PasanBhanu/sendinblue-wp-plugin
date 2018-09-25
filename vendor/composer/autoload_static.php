<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1cd402ac455ef3138dd82300a3643993
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1cd402ac455ef3138dd82300a3643993::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1cd402ac455ef3138dd82300a3643993::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
