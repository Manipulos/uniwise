<?php

namespace Uniwise\Symfony\Service\Car;

use Uniwise\Doctrine\Entity\CarRepository;

class CarService {

    /**
     * @var CarRepository
     */
    private $carRepository;
    /**
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * CarService constructor.
     * @param CarRepository $carRepository
     * @param EquipmentService $equipmentService
     */
    public function __construct(CarRepository $carRepository, EquipmentService $equipmentService) {
        $this->carRepository = $carRepository;
        $this->equipmentService = $equipmentService;
    }

    public function getCar($id) {

        return $this->carRepository->get($id);
    }

    public function getCars() {

        return $this->carRepository->getAll();
    }

    public function getCarsByMake($make) {
        return $this->carRepository->getAllByMake($make);
    }

    public function addEquipment($carId, $equipmentId) {
        $car = $this->getCar($carId);
        $equipment = $this->equipmentService->getEquipment($equipmentId);

        $car->addEquipment($equipment);

        $this->carRepository->save();

        return $car;
    }
}