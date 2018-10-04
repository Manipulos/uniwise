<?php

namespace Uniwise\Symfony\Bundle\ApiBundle\Controller\Car;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;

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
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $entityManager;

    /**
     * CarController constructor.
     * @param CarService $carService
     * @param EquipmentService $equipmentService
     */
    public function __construct(
        CarService $carService,
        EquipmentService $equipmentService)
    {
        $this->carService = $carService;
        $this->equipmentService = $equipmentService;

        //$this->entityManager = $this->getDoctrine()->getManager();
    }

    /**
     * @Get("/all")
     */
    public function getCars() {

        $cars = $this->carService->getCars();

        $carViewModels = array();
        foreach ($cars as $car) {
            $carViewModels[] = $this->mapCar($car);
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
            $carViewModels[] = $this->mapCar($car);
        }

        return $carViewModels;
    }

    /**
     * @Post("/{carId}/equipment/{equipmentId}")
     * @param $make
     */
    public function addEquipmentToCar($carId, $equipmentId) {

        $car = $this->carService->getCar($carId);
        $equipment = $this->equipmentService->getEquipment($equipmentId);

        $car->addEquipment($equipment);
        $this->entityManager->flush();
    }

    /** @var \Uniwise\Doctrine\Entity\Car $car
     * @return CarViewModel
     */
    private function mapCar($car) {
        $carViewModel = new CarViewModel();

        $carViewModel->id = $car->getId();
        $carViewModel->make = $car->getMake();
        $carViewModel->model = $car->getModel();
        $carViewModel->fuel = $car->getFuel();
        $carViewModel->color = $car->getColor();
        $carViewModel->equipments = $car->getEquipments();

        return $carViewModel;
    }
}

class CarViewModel {
    public $id;
    public $make;
    public $model;
    public $fuel;
    public $color;
    public $equipments;
}