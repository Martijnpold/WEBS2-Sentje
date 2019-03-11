<?php

    
use Mollie\Api\MollieApiClient;
use Dotenv\Dotenv;

/*
 * Make sure to disable the display of errors in production code!
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/vendor/autoload.php";

/*
 * Initialize the .env file
 */
$dotenv = new Dotenv(dirname(__DIR__ . "/.."));
$dotenv->load();

/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/dashboard/settings/profiles
 */
$mollie = new MollieApiClient();
$mollie->setApiKey($_ENV['MOLLIE_KEY']);
         