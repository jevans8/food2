<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; //router

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3; //$this->instance variable = parameter
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process default route (home page)
     */
    public function home()
    {
        //instantiate new template object
        $view = new Template();

        //display home page via render method
        echo $view->render('views/home.html');

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process order route
     */
    public function order()
    {
        //if form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //validate form data
            global $validator;
            if(!$validator->validFood($_POST['food'])) //if(!validFood($_POST['food'])){
                //OR if(!$_GLOBALS['food']->validFood($_POST['food'])){
            {
                //set an error variable in the f3 hive
                $this->_f3->set('errors["food"]', "Invalid food item");
            }
            if(!$validator->validMeal($_POST['meal'])) //if(!validMeal($_POST['meal'])){
            {
                //set an error variable in the f3 hive
                $this->_f3->set('errors["meal"]', "Invalid meal choice");
            }
            //data is valid
            if(empty($this->_f3->get('errors')))
            {
                //create an order object
                $order = new Order();
                $order->setFood($_POST['food']);
                $order->setMeal($_POST['meal']);

                //store the data in session array
                $_SESSION['order'] = $order; //store order object instead of individual elements
                //$_SESSION['food'] = $_POST['food'];
                //$_SESSION['meal'] = $_POST['meal'];

                //redirect to next order page
                $this->_f3->reroute('order2');
            }
        }

        //put variables into f3 hive
        $this->_f3->set('meals', getMeals());
        $this->_f3->set('food', $_POST['food']);
        $this->_f3->set('selectedMeal', $_POST['meal']);

        $view = new Template();
        echo $view->render('views/order.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process order2 route
     */
    public function order2()
    {
        $condiments = getCondiments();

        //if form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //add the data to the object in the session array
            $_SESSION['order']->setCondiments($_POST['condiment']);
            //$_SESSION['condiments'] = $_POST['condiment'];

            //redirect to order summary page
            $this->_f3->reroute('summary');
        }

        $this->_f3->set('condiments', $condiments); //put into f3 hive

        //instantiate new template object
        $view = new Template();

        //display page via render method
        echo $view->render('views/order2.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process summary route
     */
    public function summary()
    {
        //instantiate new template object
        $view = new Template();

        //display page via render method
        echo $view->render('views/summary.html');

        session_destroy();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process breakfast route
     */
    public function breakfast()
    {
        //instantiate new template object
        $view = new Template();

        //display page via render method
        echo $view->render('views/bfast.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process lunch route
     */
    public function lunch()
    {
        //instantiate new template object
        $view = new Template();

        //display page via render method
        echo $view->render('views/lunch.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process green eggs route
     */
    public function greenEggs()
    {
        //instantiate new template object
        $view = new Template();

        //display page via render method
        echo $view->render('views/greenEggsAndHam.html');
    }

}