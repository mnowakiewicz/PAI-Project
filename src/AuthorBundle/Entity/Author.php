<?php

namespace AuthorBundle\Entity;

use CommonBundle\Entity\CommonSuperClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="AuthorBundle\Repository\AuthorRepository")
 */
class Author extends CommonSuperClass
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=true)
     */
    private $pseudonym;

    /**
     * Author constructor.
     * @param string $name
     * @param bool $isActive
     */
    public function __construct(string $name, bool $isActive = true)
    {
        parent::__construct($isActive);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return Author
     */
    public function setName(string $name): Author
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }


    /**
     * @param string $lastName
     * @return Author
     */
    public function setLastName(string $lastName): Author
    {
        $this->lastName = $lastName;
        return $this;
    }


    /**
     * @return null|string
     */
    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }


    /**
     * @param string $pseudonym
     * @return Author
     */
    public function setPseudonym(string $pseudonym): Author
    {
        $this->pseudonym = $pseudonym;
        return $this;
    }
}

