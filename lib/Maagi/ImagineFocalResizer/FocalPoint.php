<?php
namespace Maagi\ImagineFocalResizer;

use Maagi\ImagineFocalResizer\Exception\InvalidArgumentException;

class FocalPoint implements FocalPointInterface
{
    /**
     * @var float
     */
    protected $x;

    /**
     * @var float
     */
    protected $y;

    /**
     * constructor
     * @param float $x position on x-axis (-1 to 1)
     * @param float $y position on y-axis (-1 to 1)
     */
    public function __construct($x, $y)
    {
        if (!is_numeric($x) || !is_numeric($y)) {
            throw new InvalidArgumentException('Both positions should be numeric');
        }

        $this->x = $this->ensureInBounds((float) $x);
        $this->y = $this->ensureInBounds((float) $y);
    }

    /**
     * {@inheritdoc}
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * {@inheritdoc}
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param  float $value 
     * @return float
     */
    protected function ensureInBounds($value)
    {
        if ($value < -1) {
            return -1;
        }

        if ($value > 1) {
            return 1;
        }

        return $value;
    }
}