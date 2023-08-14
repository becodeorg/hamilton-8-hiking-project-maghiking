<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0322ff46da612d2bd6965a085cf604a6
{
    public static $classMap = array (
        'ComposerAutoloaderInit0322ff46da612d2bd6965a085cf604a6' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit0322ff46da612d2bd6965a085cf604a6' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'controllers\\AuthController' => __DIR__ . '/../..' . '/controllers/AuthController.php',
        'controllers\\HikeController' => __DIR__ . '/../..' . '/controllers/HikeController.php',
        'core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'models\\Database' => __DIR__ . '/../..' . '/models/Database.php',
        'models\\Hike' => __DIR__ . '/../..' . '/models/Hike.php',
        'models\\User' => __DIR__ . '/../..' . '/models/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0322ff46da612d2bd6965a085cf604a6::$classMap;

        }, null, ClassLoader::class);
    }
}