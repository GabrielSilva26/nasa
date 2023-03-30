<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9e3f297ce038822774459c8e7d663692
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9e3f297ce038822774459c8e7d663692::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9e3f297ce038822774459c8e7d663692::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9e3f297ce038822774459c8e7d663692::$classMap;

        }, null, ClassLoader::class);
    }
}