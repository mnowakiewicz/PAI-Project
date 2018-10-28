<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 19:24
 */

namespace GoogleBooksBundle\Service;

use GoogleBooksBundle\Model\GoogleApiResponse;
use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GoogleBooksService
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * GoogleBooksService constructor.
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return GoogleApiResponse
     */
    public function getMappedModel(GoogleBooksAPIRequestParameters $parameters):GoogleApiResponse
    {
        $url = $this->createUrl($parameters->parametersToString());
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        $response = json_decode($response->getBody()->getContents(), true);
        return GoogleApiResponse::create($response);
    }

    private function createUrl(string $parametersToString) : string
    {

        $url = 'https://www.googleapis.com/books/v1/volumes?';
        $url .=
            $parametersToString .
            "&key=" .
            $this->container->getParameter('googleApiKey');

        return $url;
    }
}