<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 27.10.18
 * Time: 12:53
 */

namespace CommonBundle\Common;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class CommonSuperClass
 * @package CommonBundle\Entity
 *
 * @ORM\MappedSuperclass()
 */
abstract class CommonSuperClass implements CommonEntityMethodsInterface, \JsonSerializable
{
    /**
     * @var integer|null
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     * @ORM\Column(name="isActive", nullable=false, type="boolean", unique=false)
     */
    protected $isActive;
    /**
     * @var \DateTime
     * @ORM\Column(name="creationDate", nullable=false, unique=false, type="datetime")
     */
    protected $creationDate;
    /**
     * @var \DateTime|null
     * @ORM\Column(name="editDate", nullable=true, unique=false, type="datetime")
     */
    protected $editDate;

    /**
     * Operator constructor.
     * @param bool $isActive
     * @throws \Exception
     */
    public function __construct($isActive = true)
    {
        $this->creationDate = new \DateTime('now');
        $this->isActive = $isActive;
    }

    /**
     * @return array
     */
    protected function serializeThis():array
    {
        try {
            $reflection = new \ReflectionClass($this);
        } catch (\ReflectionException $e) {
            return [];
        }
        $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
        $parentProps = $reflection->getParentClass()->getProperties(\ReflectionProperty::IS_PROTECTED);

        $return = [];
        foreach ($props as $prop){
            $return[$prop->getName()] = call_user_func_array([$this, 'get' . ucfirst($prop->getName())], []);
        }

        foreach ($parentProps as $parentProp){
            $return[$parentProp->getName()] = call_user_func_array([$this, 'parent::get' . ucfirst($parentProp->getName())], []);
        }

        return $return;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->serializeThis();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return CommonSuperClass
     */
    public function setId(?int $id): CommonSuperClass
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }


    /**
     * @param bool $isActive
     * @return CommonEntityMethodsInterface
     */
    public function setIsActive(bool $isActive): CommonEntityMethodsInterface
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return CommonEntityMethodsInterface
     */
    public function setCreationDate(\DateTime $creationDate): CommonEntityMethodsInterface
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEditDate(): ?\DateTime
    {
        return $this->editDate;
    }

    /**
     * @param \DateTime|null $editDate
     * @return CommonEntityMethodsInterface
     */
    public function setEditDate(\DateTime $editDate): CommonEntityMethodsInterface
    {
        $this->editDate = $editDate;
        return $this;
    }



}