<?php

namespace Uniwise\Symfony\Service\Car;

use Uniwise\Doctrine\Entity\CarRepository;

class CarService {

    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * CarService constructor.
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository) {
        $this->carRepository = $carRepository;
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
}