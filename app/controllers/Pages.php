<?php

class Pages extends Controller {
    public function __construct(){
        // echo 'Pages loaded';
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        // $this->view('Hello');
        $data = [
            'title' => 'Welcome'
        ];
        $this->view('pages/index', $data);
    }

   
    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];  

        $this->view('pages/about', $data);
    }
}