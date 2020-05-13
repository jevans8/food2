<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/dataLayer.php');
require_once('model/validate.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

// :: invokes static method
// -> invokes instance method

///////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET /', function(){

    //instantiate new template object
    $view = new Template();

    //display home page via render method
    echo $view->render('views/home.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Breakfast route
$f3->route('GET /breakfast', function(){

    //instantiate new template object
    $view = new Template();

    //display page via render method
    echo $view->render('views/bfast.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Breakfast - green eggs and ham route
$f3->route('GET /breakfast/greenEggs', function(){

    //instantiate new template object
    $view = new Template();

    //display page via render method
    echo $view->render('views/greenEggsAndHam.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Lunch route
$f3->route('GET /lunch', function(){

    //instantiate new template object
    $view = new Template();

    //display page via render method
    echo $view->render('views/lunch.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order route
$f3->route('GET|POST /order', function($f3){

    //$meals = getMeals();

    //if form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //var_dump($_POST); //array(2) { ["food"]=> string(5) "pizza" ["meal"]=> string(6) "dinner" }

        //validate form data
        if(!validFood($_POST['food'])){

            //set an error variable in the f3 hive
            $f3->set('errors["food"]', "Invalid food item");

        }
        if(!validMeal($_POST['meal'])){

            //set an error variable in the f3 hive
            $f3->set('errors["meal"]', "Invalid meal choice");

        }
        //data is valid
        if(empty($f3->get('errors'))) {

            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            //redirect to next order page
            $f3->reroute('order2');

        }
    }

    //put variables into f3 hive
    $f3->set('meals', getMeals());
    $f3->set('food', $_POST['food']);
    $f3->set('selectedMeal', $_POST['meal']);

    $view = new Template();
    echo $view->render('views/order.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order2 route
$f3->route('GET|POST /order2', function($f3){

    $condiments = getCondiments();

    //if form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['condiments'] = $_POST['condiment'];

        //redirect to order summary page
        $f3->reroute('summary');

    }

    $f3->set('condiments', $condiments); //put into f3 hive

    //instantiate new template object
    $view = new Template();

    //display page via render method
    echo $view->render('views/order2.html');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Order summary route
$f3->route('GET /summary', function(){

    //instantiate new template object
    $view = new Template();

    //display page via render method
    echo $view->render('views/summary.html');

    session_destroy();

});

///////////////////////////////////////////////////////////////////////////////////////////////////
//Run F3
$f3->run();