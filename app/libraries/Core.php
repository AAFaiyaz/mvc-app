<?php

// * App Core Class
// * Creates URL & loads core controller
// * URL FORMAT - /controller/method/params

class Core 
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];


    public function __construct()
    {
        // $this->getUrl();
        // print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in controllers for first value

       if(isset($url[0])){ // this isset() is for a new version
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        } 
       }


        //Require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';

        //instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if(isset($url[1])){
            //Check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        // echo $this->currentMethod;
        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/'); // rtrim is removing the last /  eg. /posts/extra/ 
            $url = filter_var($url, FILTER_SANITIZE_URL); //should not any character hat url should not have
            $url = explode('/', $url); // put the url into an array 
            return $url;
        }
    }
}