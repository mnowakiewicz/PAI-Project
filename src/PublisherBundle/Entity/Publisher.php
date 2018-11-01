<?php

namespace PublisherBundle\Entity;

use CommonBundle\Entity\CommonSuperClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="publisher")
 * @ORM\Entity(repositoryClass="BookBundle\Repository\PrintTypeRepository")
 */
class Publisher extends CommonSuperClass
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * Publisher constructor.
     * @param string $name
     * @param bool $isActive
     */
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
     * @return Publisher
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

