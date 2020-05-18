<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php'); //install f3
require_once('model/dataLayer.php');
//require_once('model/validate.php'); //not necessary because composer.json "autoload"
//require_once('classes/order.php'); //not necessary because composer.json "autoload"

//Start a session AFTER requiring autoload
session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();
$validator = new Validate(); //validation object
$controller = new Controller($f3); //controller object

// :: invokes static method
// -> invokes instance method

///////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET /', function()
{
    $GLOBALS['controller']->home();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Breakfast route
$f3->route('GET /breakfast', function()
{
    $GLOBALS['controller']->breakfast();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Breakfast - green eggs and ham route
$f3->route('GET /breakfast/greenEggs', function()
{
    $GLOBALS['controller']->greenEggs();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Lunch route
$f3->route('GET /lunch', function()
{
    $GLOBALS['controller']->lunch();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order route
$f3->route('GET|POST /order', function()
{
    $GLOBALS['controller']->order();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order2 route
$f3->route('GET|POST /order2', function()
{
    $GLOBALS['controller']->order2();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order summary route
$f3->route('GET /summary', function()
{
    $GLOBALS['controller']->summary();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Run F3
$f3->run();