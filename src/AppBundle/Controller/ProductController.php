<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllOrderedByName();
        
        return $this->json($products);
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}


