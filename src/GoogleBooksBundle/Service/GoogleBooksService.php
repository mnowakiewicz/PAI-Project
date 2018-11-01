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
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GoogleBooksService
 * @package GoogleBooksBundle\Service
 */
class GoogleBooksService
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * GoogleBooksService constructor.
     * @param ContainerInterface $container
     * @param Logger $logger
     */
    public function __construct(ContainerInterface $container, Logger $logger)
    {
        $this->container = $container;
        $this->logger = $logger;
    }


    /**
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return GoogleApiResponse
     */
    public function getMappedModel(GoogleBooksAPIRequestParameters $parameters):GoogleApiResponse
    {
        $url = $this->createUrl($this->parametersToString($parameters));
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        $response = json_decode($response->getBody()->getContents(), true);
        dump($response);
        return GoogleApiResponse::create($response);
    }

    /**
     * @param string $parametersToString
     * @return string
     */
    private function createUrl(string $parametersToString) : string
    {

        $url = 'https://www.googleapis.com/books/v1/volumes?';
        $url .=
            $parametersToString .
            "&key=" .
            $this->container->getParameter('googleApiKey');

        return $url;
    }

    /**
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return string
     */
    private function parametersToString(GoogleBooksAPIRequestParameters $parameters): string
    {
        $props = $this->getPrivateClassFields($parameters);

        $string = '';
        if (count($props)) {
            for ($i = 0; $i < count($props); $i++) {
                $functionName = 'get' . ucfirst($props[$i]->getName());
                if (call_user_func_array([$this, $functionName], []) != null) {
                    $string .= $props[$i]->getName() . '=' . call_user_func_array([$this, $functionName], []) . '&';
                }
            }
            $string = substr($string, 0, -1);
        }
        return $string;
    }


    /**
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return array|\ReflectionProperty
     */
    private function getPrivateClassFields(GoogleBooksAPIRequestParameters $parameters): \ReflectionProperty
    {
        try {
            $reflect = new \ReflectionClass($parameters);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
        } catch (\ReflectionException $e) {
            $props = [];
            $this->logger->error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        return $props;
    }
}