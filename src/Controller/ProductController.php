<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', methods: 'GET')]
    public function getProducts(ProductRepository $productRepository): JsonResponse {
        $products = $productRepository->findAll();
        var_dump($products);
        return $this->json($products);
    }

    #[Route('/product', methods: 'POST')]
    public function createProduct(Request $request, EntityManagerInterface $em): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $em->persist($product);
        $em->flush();
        return $this->json($data);
    }
}
