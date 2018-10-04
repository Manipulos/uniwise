<?php
namespace Uniwise\Doctrine\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CarRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Car::class);
    }

    /**
     * @param $id
     * @return object|Car
     */
    public function get($id) {
        return $this->find($id);
    }

    /**
     * @return array|Car[]
     */
    public function getAll() {
        return $this->findAll();
    }

    /**
     * @param $make
     * @return array|Car[]
     */
    public function getAllByMake($make) {

        return $this->findBy(array('make' => $make));
    }
}

