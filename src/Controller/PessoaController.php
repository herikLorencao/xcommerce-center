<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Service\Serializer\CustomSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/api/pessoa")
 */
class PessoaController extends AbstractController
{

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("", methods={"POST","HEAD"})
     */
    public function create(Request $request)
    {
        dd(json_decode($request->getContent()));
        // $pessoa = $serializer->deserialize($request->getContent(), Pessoa::class);
        // dump($pessoa);
        // return new Response($serializer->serialize($pessoa), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    // /**
    //  * @Route("/{id}", methods={"PUT"})
    //  */
    // public function edit(int $id)
    // {
    //     return new Response(json_encode(['id' => $id, 'METHOD' => 'PUT']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    // }

    // /**
    //  * @Route("/{id}", methods={"DELETE"})
    //  */
    // public function delete($id)
    // {
    //     return new Response(json_encode(['id' => $id, 'METHOD' => 'DELETE']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    // }

    // /**
    //  * @Route("/{id}", methods={"GET","HEAD"})
    //  */
    // public function findById(int $id)
    // {
    //     // ... return a JSON response with the post
    //     // throw new Exception("Exceção de teste");
    //     return new Response(json_encode(['id' => $id]), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    // }

    // /**
    //  * @Route("", methods={"GET","HEAD"})
    //  */
    // public function findAll(Request $request)
    // {
    //     dump($request->query->get('filter'));
    //     // ... return a JSON response with the post
    //     // throw new Exception("Exceção de teste");
    //     return new Response(json_encode(['METHOD' => 'findAll']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    // }
}
