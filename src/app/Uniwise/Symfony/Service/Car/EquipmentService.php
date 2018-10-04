<?php

namespace Uniwise\Symfony\Service\Car;

use Uniwise\Doctrine\Entity\EquipmentRepository;

class EquipmentService
{
    /**
     * @var EquipmentRepository
     */
    private $equipmentRepository;

    /**
     * EquipmentService constructor.
     * @param EquipmentRepository $equipmentRepository
     */
    public function __construct(EquipmentRepository $equipmentRepository) {
        $this->equipmentRepository = $equipmentRepository;
    }

    public function getEquipment($id) {

        return $this->equipmentRepository->get($id);
    }
}