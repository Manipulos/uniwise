<?php
namespace Uniwise\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CarRepository")
 * @ORM\Table(name="car")
 */
class Car {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @var string
     */
    private $make;

    /**
     * @ORM\Column(type="string", length=40)
     * @var string
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=20)
     * @var string
     */
    private $fuel;

    /**
     * @ORM\Column(type="string", length=20)
     * @var string
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity="Equipment")
     * @ORM\JoinTable(name="carEquipment",
     *      joinColumns={@ORM\JoinColumn(name="carId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipmentId", referencedColumnName="id")}
     *      )
     * @var Equipment[]
     */
    private $equipments;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMake() {
        return $this->make;
    }

    /**
     * @param string $make
     * @return Car
     */
    public function setMake($make) {
        $this->make = $make;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getFuel() {
        return $this->fuel;
    }

    /**
     * @param string $fuel
     * @return Car
     */
    public function setFuel($fuel) {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Car
     */
    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    /**
     * @return Equipment[]
     */
    public function getEquipments() {
        return $this->equipments;
    }

    /**
     * @param Equipment $equipment
     * @return Car
     */
    public function addEquipment($equipment) {
        $this->equipments[] = $equipment;
        return $this;
    }

    /**
     * @param Equipment $equipmentToRemove
     * @return Car
     */
    public function removeEquipment($equipmentToRemove) {
        foreach ($this->equipments as $index => $equipment) {
            if ($equipment === $equipmentToRemove) {
                array_splice($this->equipments, $index,1);
                break;
            }
        }
        return $this;
    }

    public function __construct() {
        $this->equipments = new \Doctrine\Common\Collections\ArrayCollection();
    }
}