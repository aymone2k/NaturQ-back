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




class ProposalController extends AbstractController
{
    #[Route('/proposal/{id}', name: 'proposal')]
    public function proposal($id): Response
    {   
        $repository = $this->getDoctrine() ->getRepository(Proposal::class);
        $proposal = $repository->find($id);
        $proposal=$this->getDoctrine()->getRepository(Proposal::class)->find($id);
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($proposal, 'json', [
            'Depth' => 10,
            'circular_reference_handler' => function ($json) {
        
                return $json->getId();

            }]);
            return new Response($json);
    }
           
}
