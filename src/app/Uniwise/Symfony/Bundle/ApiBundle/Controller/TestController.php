<?php
namespace Uniwise\Symfony\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Uniwise\Symfony\Service\TestService;

/**
 * @Route("/")
 */
class TestController extends FOSRestController {

    /**
     * @var TestService
     */
    private $testService;

    public function __construct(TestService $testService) {
        $this->testService = $testService;
    }

    /**
     * @param Request $request
     * @Get("/")
     *
     * @return \FOS\RestBundle\View\View
     */
    public function getList(Request $request) {
        return $this->view($this->testService->helloWorld());
    }
}