<?php
namespace Uniwise\Mappers;

use Uniwise\ViewModels\CarViewModel;

class CarMapper
{
    /**
     * @var EquipmentMapper
     */
    private $equipmentMapper;

    /**
     * CarMapper constructor.
     * @param EquipmentMapper $equipmentMapper
     */
    public function __construct(EquipmentMapper $equipmentMapper) {

        $this->equipmentMapper = $equipmentMapper;
    }
    /** @var \Uniwise\Doctrine\Entity\Car $car
     * @return CarViewModel
     */
    public function Map($car) {
        $carViewModel = new CarViewModel();

        $mappedEquipments = array();
        foreach ($car->getEquipments() as $equipment)
            $mappedEquipments[] = $this->equipmentMapper->Map($equipment);

        $carViewModel->id = $car->getId();
        $carViewModel->make = $car->getMake();
        $carViewModel->model = $car->getModel();
        $carViewModel->fuel = $car->getFuel();
        $carViewModel->color = $car->getColor();
        $carViewModel->equipments = $mappedEquipments;

        return $carViewModel;
    }
}