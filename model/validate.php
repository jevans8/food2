<?php

/**
 * Class Validate
 * Contains the validation methods for my app
 * @author Julia Evans
 * @version 1.0
 */
class Validate
{
    /**
     * Return a value indicating if food param is valid
     * Valid foods are not empty and do not contain anything except letters
     * @param $food
     * @return bool
     */
    function validFood($food)
    {
        //remove spaces
        $food = str_replace(' ', '', $food);
        return !empty($food) && ctype_alpha($food);
    }

    //testing
    //echo validFood("french fries") ? "true" : "false"; //should print true
    //echo validFood("pizza") ? "true" : "false"; //should print true
    //echo validFood("7-layer dip") ? "true" : "false"; //should print false
    //echo validFood("") ? "true" : "false"; //should print false

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Return a value indicating if meal is valid
     * Valid meals are breakfast, lunch and dinner
     * @param $meal
     * @return bool
     */
    function validMeal($meal)
    {
        $meals = getMeals();
        return in_array($meal, $meals);
    }

    //echo validMeal('breakfast') ? "true" : "false"; //should return true
    //echo validMeal('lunch') ? "true" : "false"; //should return true
    //echo validMeal('dinner') ? "true" : "false"; //should return true
    //echo validMeal('dessert') ? "true" : "false"; //should return false
    //echo validMeal('') ? "true" : "false"; //should return false

}

