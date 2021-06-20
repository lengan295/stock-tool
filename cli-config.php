<?php

require __DIR__ . '/vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new \DI\ContainerBuilder();

// Set up settings
$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);

$container = $containerBuilder->build();
/** @var \App\Application\Settings\SettingsInterface $settings */
$settings = $container->get(\App\Application\Settings\SettingsInterface::class);

$paths = array("src");
$isDevMode = true;
$dbParams = $settings->get('database');

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
$conn = $entityManager->getConnection();
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

