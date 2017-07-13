<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    // Getters&Setters
    public function getId(){
        return $this->id;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function setDescription($desc){
        $this->description = $desc;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    
}

