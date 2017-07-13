<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route("/about")
     */
    public function aboutAction(){
        $number = mt_rand(0,100);
        
        $data = array("test" => 1);
        
        return $this->json($data);
        
    }
    
}

