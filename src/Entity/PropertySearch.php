<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
    /**
    * @var int|null
    */
    private $maxPrice;

    /**
    * @var int|null
    * @Assert\Range (min=10)
    */
    private $minSurface;

    /**
    * @var ArrayCollection
    */
    private $options;

    public function __construct ()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     *
     * @return self
     */
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     *
     * @return self
     */
    public function setMinSurface(int $minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     *
     * @return self
     */
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}
