<?php

/**
 * My Application bootstrap file.
 */
use Nette\Application\Routers\Route;


// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';


// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode($configurator::NONE);
$configurator->enableDebugger(__DIR__ . '/../log');
//\Nette\Diagnostics\Debugger::enable();

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(LIBS_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$container = $configurator->createContainer();

// Setup router
$container->router[] = new Route('index.php', 'Basic:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>/<action>[/<id>]', 'Basic:default');


\Nette\Diagnostics\Debugger::enable(\Nette\Diagnostics\Debugger::DEVELOPMENT);

// Configure and run the application!
$container->application->run();
