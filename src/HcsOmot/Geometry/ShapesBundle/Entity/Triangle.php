<?php

namespace HcsOmot\Geometry\ShapesBundle\Entity;

use InvalidArgumentException;

/**
 * Class Triangle
 *
 * @package HcsOmot\Geometry\ShapesBundle\Entity
 */
class Triangle implements ShapeInterface
{
    /**
     * @var float a triangle side
     */
    protected $sideA;
    /**
     * @var float a triangle side
     */
    protected $sideB;
    /**
     * @var float a triangle side
     */
    protected $sideC;
    protected $area;
    protected $perimeter;

    /**
     * Triangle constructor.
     *
     * @param float $sideA
     * @param float $sideB
     * @param float $sideC
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(float $sideA, float $sideB, float $sideC)
    {
        if ($this->isValid($sideA, $sideB, $sideC)) {
            $this->sideA = $sideA;
            $this->sideB = $sideB;
            $this->sideC = $sideC;

            $this->calculatePerimeter();
            $this->calculateArea();
        }

    }

    /**
     * Check if a valid circle can be constructed
     *
     * @param float $sideA
     * @param float $sideB
     * @param float $sideC
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    private function isValid(float $sideA, float $sideB, float $sideC): bool
    {
        if (($sideA + $sideB > $sideC) && ($sideA + $sideC > $sideB) && ($sideB + $sideC > $sideA)){
            return true;
        }

        throw new InvalidArgumentException('Tried to instantiate a triangle with improper length sides.');
    }

    /**
     * Return the perimeter size of triangle
     * @return float
     */
    public function getPerimeter(): float
    {
        return $this->perimeter;
    }

    /**
     * Return the area size of triangle
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }


    /**
     * Calculate the perimeter size of triangle
     */
    private function calculatePerimeter()
    {
        $this->perimeter = $this->sideA + $this->sideB + $this->sideC;
    }

    /**
     * * Calculate the area of the triangle
     */
    private function calculateArea()
    {
        $semiperimeter = $this->perimeter / 2;
        $area = sqrt($semiperimeter * ($semiperimeter - $this->sideA)*($semiperimeter - $this->sideB)*($semiperimeter - $this->sideC));

        $this->area = $area;
    }
}
