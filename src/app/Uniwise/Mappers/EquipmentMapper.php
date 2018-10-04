<?php
namespace Uniwise\Mappers;

use Uniwise\ViewModels\EquipmentViewModel;

class EquipmentMapper
{
    /** @var \Uniwise\Doctrine\Entity\Equipment $equipment
     * @return EquipmentViewModel
     */
    public function Map($equipment) {
        $equipmentViewModel = new EquipmentViewModel();

        $equipmentViewModel->id = $equipment->getId();
        $equipmentViewModel->name = $equipment->getName();

        return $equipmentViewModel;
    }
}