<?php 

class SiteController extends Controller
{
    public function __construct()
    {
        
    }

    public function index($get) 
    {
        $externalFiles = [
            'css' => [
                '../Web/css/main.css',
            ],
            'js' => [
                '../Web/js/main.js',
            ]
        ];

        return $this->render('index', $externalFiles);
    }

    public function about($get) 
    {
        return $this->render('about');
    }
}