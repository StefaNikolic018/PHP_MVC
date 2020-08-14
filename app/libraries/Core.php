<?php 

/*
 *--------------------------------------------
 * App Core Class
 * Creates URL & Loads Core Controller
 * URL FORMAT : /controller/method/parameters
 * --------------------------------
 */

class Core {
    /*
     *--------------------------------------- 
     * Protected properties - to be inherrited
     * 
     * @currentController - Pages is default
     * @currentMethod - index is default
     * @parameters - needs to be filled
     * ------------------------------
     */
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params=[];

    /*
     *--------------------------------------- 
     * Constructor
     * Breaking URL into Controller, Method and Parameters
     * 
     * @url - variable that keeps the url
     * ------------------------------
     */
    public function __construct()
    {
        
        $url=$this->getUrl();

        //Look in controllers for first value - CONTROLLER
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            //If exists, set as controller
            $this->currentController=ucwords($url[0]);

            //Unset 0 index
            unset($url[0]);
        }

        //Require the controller
        require_once '../app/controllers/'.$this->currentController.'.php';

        //Instatiate controller class
        $this->currentController = new $this->currentController;

        //Check for second part of url - METHOD
        if(isset($url[1])){
            //Check if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod=$url[1];
                //Unset 1 index
                unset($url[1]);
            }
        }
        //Check for params 
        $this->params=$url ? array_values($url) : [];

        //Call a callback with array of params 
        call_user_func_array([$this->currentController, $this->currentMethod],$this->params);
    }

    /*
     *--------------------------------------- 
     * URL GETTER
     * -Trimming
     * -Filtering
     * -Exploding
     * 
     * @returns url
     * ------------------------------
     */
    public function getUrl(){

        //Checking for url
        if(isset($_GET['url']))
        {
            //Get the url
            $url=$_GET['url'];
            //Triming backslashes from end
            $url=rtrim($url,'/');
            //Filtering for unwanted chars
            $url=filter_var($url,FILTER_SANITIZE_URL);
            //Creating an array, dividing words by /
            $url=explode('/',$url);

            //Returning url
            return $url;

        }

    }

}
