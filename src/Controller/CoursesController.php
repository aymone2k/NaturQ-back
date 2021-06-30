<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

use App\Entity\Course;
use App\Entity\Proposal;
use App\Entity\Result;




class CoursesController extends AbstractController
{
    #[Route('/course/{id}', name: 'course')]
    public function course($id): Response
    {   
        $repository = $this->getDoctrine() ->getRepository(Course::class);
        $course = $repository->find($id);
        $course=$this->getDoctrine()->getRepository(Course::class)->find($id);
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($course, 'json', [
            'Depth' => 10,
            'circular_reference_handler' => function ($json) {
        
                return $json->getId();

            }]);
            return new Response($json);
    }
           
}

