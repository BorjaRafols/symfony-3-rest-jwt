<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Product;

class ProductController extends Controller
{
    
    public function __construct(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        
        $this->serializer = new Serializer($normalizers, $encoders);
    }
    
    private function serializeProduct($product) {
        
        return array(
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "description" => $product->getDescription(),
            
        );
        
    } 
    
    /**
     * @Route("/products", name="products.index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllOrderedByName();
            
        $serialized_products = array();
        foreach($products as $product) {
            $serialized_products[] = $this->serializeProduct($product);
        }
    
        $response = array(
            "status" => 200,
            "message" => "OK",
            "products" => $serialized_products
        );
        
        return new JsonResponse($response);
    }
    
    /**
     * @Route("/products/create", name="products.create")
     * @Method("POST")
     */
    public function createAction(){
        
        $em = $this->getDoctrine()->getManager();
    
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        
        $product = $this->serializer->serialize($product, 'json');
            
        $response = array(
            "status" => 200,
            "message" => "product created",
            "product" => $product
        );    
            
        return new Response($product);
        
        
    }
}


