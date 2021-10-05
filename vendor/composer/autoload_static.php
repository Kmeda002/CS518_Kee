<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit60d525d3f16d90caff9b810e178dc5a5
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit60d525d3f16d90caff9b810e178dc5a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit60d525d3f16d90caff9b810e178dc5a5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit60d525d3f16d90caff9b810e178dc5a5::$classMap;

        }, null, ClassLoader::class);
    }
}