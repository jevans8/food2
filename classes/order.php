<?php

class Order
{
    //declare instance variables
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Default constructor
     * @param $food the food
     * @param $meal the meal
     * @param $condiments the condiments
     */
    public function __construct($food = "scrambled eggs", $meal = "breakfast", $condiments = array("salt", "pepper"))
    {
        //MUST use 'this' reference in php
        $this->_food = $food; //OR $this->setFood($food);
        $this->_meal = $meal; //OR $this->setMeal($meal);
        $this->_condiments = $condiments; //OR $this->setCondiments($condiments);
    }

    /**
     * toString() returns a String representation of an order object
     * @return String
     */
    public function toString()
    {
        $out = $this->_food . " for ";
        $out .= $this->_meal . " with ";
        if(!empty($this->_condiments)){
            $out .= implode($this->_condiments, " and ");
        }

        return $out;
    }

    /**
     * @return string|the
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * @param string|the $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * @return string|the
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * @param string|the $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * @return string[]|the
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * @param string[]|the $condiments
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }

}


//testing only
//$order = new Order("pizza", "lunch", array("cheese"));
//echo $order->toString() . "<br>";
//
//$order2 = new Order();
//echo $order2->toString() . "<br>";