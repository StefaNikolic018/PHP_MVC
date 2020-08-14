<?php 
//Define a class
class Pages extends Controller {

    //Constructor
    public function __construct(){
        //Instance of models here
    }

    //Index method
    public function index()
    {
        //Data array
        $data = [
            'view'=>'pages/index',
            'title' => 'Welcome to KoochMVC !'
        ];

        

        //Returning view
        $this->view('pages/layout',$data);
    }

    //Pages method
    public function about()
    {
        $data = [
            'view'=>'pages/about',
            'title'=>'About'
        ];
        //Returning view
        $this->view('pages/layout',$data);
    }


}