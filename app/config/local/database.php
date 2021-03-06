<?php

return array(

	'default' => 'local',
	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		'local' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'db_tll',
			'username'  => 'sa',
			'password'  => 'sa',
			'port'		=> '3307',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => '192.168.99.9',
			'database'  => 'db_tll',
			'username'  => '13baht',
			'password'  => 'adminpass',
			'port'		=> '3396',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'homestead',
			'username' => 'homestead',
			'password' => 'secret',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),

	),

);
