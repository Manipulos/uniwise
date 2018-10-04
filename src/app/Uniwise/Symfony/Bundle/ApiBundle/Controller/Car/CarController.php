<?php

namespace Uniwise\Symfony\Bundle\ApiBundle\Controller\Car;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;

use Uniwise\Mappers\CarMapper;
use Uniwise\Symfony\Service\Car\CarService;
use Uniwise\Symfony\Service\Car\EquipmentService;

/**
 * @Route("/car")
 */
class CarController extends FOSRestController {
    /**
     * @var CarService
     */
    private $carService;

    /**
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * @var CarMapper
     */
    private $carMapper;

    /**
     * CarController constructor.
     * @param CarService $carService
     * @param EquipmentService $equipmentService
     * @param CarMapper $carMapper
     */
    public function __construct(
        CarService $carService,
        EquipmentService $equipmentService,
        CarMapper $carMapper)
    {
        $this->carService = $carService;
        $this->equipmentService = $equipmentService;

        $this->carMapper = $carMapper;
    }

    /**
     * @Get("/all")
     */
    public function getCars() {
        $cars = $this->carService->getCars();

        $carViewModels = array();
        foreach ($cars as $car) {
            $carViewModels[] = $this->carMapper->Map($car);
        }

        return $carViewModels;
    }

    /**
     * @Get("/filtered/{make}")
     * @param $make
     * @return array
     */
    public function getCarsByMake($make) {
        $cars = $this->carService->getCarsByMake($make);

        $carViewModels = array();
        foreach ($cars as $car) {
            $carViewModels[] = $this->carMapper->Map($car);
        }

        return $carViewModels;
    }

    /**
     * @Post("/{carId}/equipment/{equipmentId}")
     * @param $carId
     * @param $equipmentId
     * @return \Uniwise\ViewModels\CarViewModel
     */
    public function addEquipmentToCar($carId, $equipmentId) {
        $car = $this->carService->getCar($carId);
        $equipment = $this->equipmentService->getEquipment($equipmentId);

        $car->addEquipment($equipment);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $carViewModels[] = $this->carMapper->Map($car);
    }
}