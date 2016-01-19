<?php
namespace Maagi\ImagineFocalResizer;

interface FocalPointInterface
{
    /**
     * returns position on x-axis (-1 to 1)
     * 
     * @return float
     */
    public function getX();

    /**
     * returns position on y-axis (-1 to 1)
     * 
     * @return float
     */
    public function getY();
}