<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

use App\Entity\Question;
use App\Entity\Proposal;
use App\Entity\Result;




class QuestionController extends AbstractController
{
    #[Route('/question/{id}', name: 'question')]
    public function question($id): Response
    {   
        $repository = $this->getDoctrine() ->getRepository(Question::class);
        $question = $repository->find($id);
        $question=$this->getDoctrine()->getRepository(Question::class)->find($id);
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($question, 'json', [
            'Depth' => 10,
            'circular_reference_handler' => function ($json) {
        
                return $json->getId();

            }]);
            return new Response($json);
    }
           
}
