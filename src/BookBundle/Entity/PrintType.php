<?php

namespace BookBundle\Entity;

use CommonBundle\Entity\CommonSuperClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrintType
 *
 * @ORM\Table(name="printType")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\PrintTypeRepository")
 */
class PrintType extends CommonSuperClass
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    public function __construct(string $name, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PrintType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

