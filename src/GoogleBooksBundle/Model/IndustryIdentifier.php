<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 23:33
 */

namespace GoogleBooksBundle\Model;


/**
 * Class IndustryIdentifier
 * @package GoogleBooksBundle\Model
 */
class IndustryIdentifier
{
    /**
     * @var string|null
     */
    private $type;
    /**
     * @var string|null
     */
    private $identifier;

    /**
     * IndustryIdentifier constructor.
     */
    public function __construct()
    {
    }


    /**
     * @param array $industryIdentifierData
     * @return IndustryIdentifier
     * @throws \ReflectionException
     */
    public static function create(array $industryIdentifierData): IndustryIdentifier
    {
        $identifier = new IndustryIdentifier();
        $reflection = new \ReflectionClass($identifier);
        $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($props as $prop){
            $propName = $prop->getName();

            if(array_key_exists($propName, $industryIdentifierData)){
                $functionName = 'set' . ucfirst($prop->getName());
                $data = $industryIdentifierData[$propName];
                call_user_func_array([$identifier, $functionName], [$data]);
            }
        }

        return $identifier;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return IndustryIdentifier
     */
    public function setType(string $type): IndustryIdentifier
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return IndustryIdentifier
     */
    public function setIdentifier(string $identifier): IndustryIdentifier
    {
        $this->identifier = $identifier;
        return $this;
    }




}