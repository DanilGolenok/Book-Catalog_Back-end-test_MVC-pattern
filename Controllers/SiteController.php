<?php 

class SiteController extends Controller
{
    public function __construct()
    {
        
    }

    public function index($get) 
    {
        return $this->render('index');
    }

    public function about($get) 
    {
        echo "";
    }
}