<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:32
 */

namespace BookBundle\Model;


class GoogleApiResponse
{
    /**
     * @var string
     */
    private $kind;
    /**
     * @var string
     */
    private $totalItems;
    /**
     * @var Item[]
     */
    private $items;

    /**
     * GoogleApiResponse constructor.
     */
    public function __construct()
    {
    }

    public static function create(array $googleApiResponseData): GoogleApiResponse
    {
        $return = new GoogleApiResponse();

        $items = array_map(function ($data){
            return Item::create($data);
        },$googleApiResponseData["items"]);

        $return
            ->setKind($googleApiResponseData["kind"])
            ->setTotalItems($googleApiResponseData["totalItems"])
            ->setItems($items);

        return $return;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     * @return GoogleApiResponse
     */
    public function setKind(string $kind): GoogleApiResponse
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalItems(): string
    {
        return $this->totalItems;
    }

    /**
     * @param string $totalItems
     * @return GoogleApiResponse
     */
    public function setTotalItems(string $totalItems): GoogleApiResponse
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     * @return GoogleApiResponse
     */
    public function setItems(array $items): GoogleApiResponse
    {
        $this->items = $items;
        return $this;
    }


}