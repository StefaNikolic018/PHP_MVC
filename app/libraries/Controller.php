<?php 

/*
 *----------------------------------
 * Base controller
 * Loads the Models and Views
 * And is being inherrited by every other controller
 * -------------------
 */

 class Controller {
    
    //Model method
    public function model($model)
    {
        //Require model file
        require_once('../app/models/'.$model.'.php');
        
        //Return model
        return new $model;
    }

    //View method -> Passing layout as variable and view in data params
    public function view($view,$data=[])
    {
        //Check for view file
        if(file_exists('../app/views/'.$view.'.php'))
        {
            require_once('../app/views/'.$view.'.php');
        } else {
            die('View does not exist!');
        }
    }



 }
