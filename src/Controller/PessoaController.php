<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api/pessoa")
 */
class PessoaController extends AbstractController
{
    private $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @IsGranted("ROLE_OAUTH2_READ")
     * @Route("", methods={"POST","HEAD"})
     */
    public function create(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // $user = new User();
        // $user->setUsername('admin')
        //     ->setEmail('admin@admin.com.br')
        //     ->setIsActive(true);
        // $user->setPassword($encoder->encodePassword($user, 'admin'));

        // $this->repo->save($user);
        // $this->repo->
        dd(json_decode($request->getContent()));
        // $pessoa = $serializer->deserialize($request->getContent(), Pessoa::class);
        // dump($pessoa);
        // return new Response($serializer->serialize($pessoa), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @IsGranted("ROLE_OAUTH2_READ")
     * @Route("/cadastrar", methods={"POST","HEAD"})
     */
    public function createClient(Request $request, KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $identifier = hash('md5', random_bytes(16));
        $secret = hash('sha512', random_bytes(32));

        $input = new ArrayInput([
            'command' => 'trikoder:oauth2:create-client',
            'identifier' =>  $identifier,
            'secret' =>  $secret,
            '--grant-type' => ['client_credentials'],
            '--scope' => ['read']
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        return new JsonResponse(['identifier' => $identifier, 'secret' => $secret], Response::HTTP_OK);
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
