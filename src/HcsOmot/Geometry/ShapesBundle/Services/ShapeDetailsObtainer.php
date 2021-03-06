<?php

namespace HcsOmot\Geometry\ShapesBundle\Services;

use HcsOmot\Geometry\ShapesBundle\Entity\Circle;
use HcsOmot\Geometry\ShapesBundle\Entity\Triangle;

class ShapeDetailsObtainer
{
    public function getShapeDetails($shape): array
    {
        $shapeType = get_class($shape);
        switch ($shapeType) {
            case "HcsOmot\Geometry\ShapesBundle\Entity\Triangle":
                $type      = 'triangle';
                $area      = $this->calculateTriangleArea($shape);
                $perimeter = $this->calculateTrianglePerimeter($shape);
                break;
            case "HcsOmot\Geometry\ShapesBundle\Entity\Circle":
                $type      = 'circle';
                $area      = $this->calculateCircleArea($shape);
                $perimeter = $this->calculateCirclePerimeter($shape);
                break;
            default:
                throw new \InvalidArgumentException('Currently supported types are Triangle and Circle.');
        }

        return [
            'type'      => $type,
            'area'      => $area,
            'perimeter' => $perimeter,
        ];
    }

    public function calculateTriangleArea(Triangle $triangle)
    {
        $semiperimeter = $this->calculateTrianglePerimeter($triangle) / 2;

        return sqrt($semiperimeter * ($semiperimeter - $triangle->getSideA()) * ($semiperimeter - $triangle->getSideB()) * ($semiperimeter - $triangle->getSideC()));
    }

    public function calculateTrianglePerimeter(Triangle $triangle)
    {
        return $triangle->getSideA() + $triangle->getSideB() + $triangle->getSideC();
    }

    public function calculateCircleArea(Circle $circle)
    {
        return M_PI * ($circle->getRadius() ** 2);
    }

    public function calculateCirclePerimeter(Circle $circle)
    {
        return 2 * $circle->getRadius() * M_PI;
    }
}
