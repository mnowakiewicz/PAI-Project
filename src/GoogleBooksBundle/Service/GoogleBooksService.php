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
     * Returns mapped googleBookApi response (json) to PHP Object.
     *
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return GoogleApiResponse
     */
    public function getMappedModel(GoogleBooksAPIRequestParameters $parameters):GoogleApiResponse
    {
        $url = $this->createUrl($this->parametersToString($parameters));

        $this->logger->info('Sending list request to GoogeApiBooks', [
            'url' => $url,
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $response = json_decode($response->getBody()->getContents(), true);
        dump($response);
        return GoogleApiResponse::create($response);
    }

    /**
     * Creates URL,
     * example https://www.googleapis.com/books/v1/volumes?q={value}$key={googleApiKey}
     *
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
     * Returns string in a format {parameter1}={value1}&{parameter2}={value2}&...{parameterN}={valueN}
     *
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return string
     */
    private function parametersToString(GoogleBooksAPIRequestParameters $parameters): string
    {
        $fields = $this->getPrivateClassFields($parameters);

        $string = '';
        if (count($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $functionName = 'get' . ucfirst($fields[$i]->getName());
                if (call_user_func_array([$parameters, $functionName], []) != null) {
                    $string .= $fields[$i]->getName() . '=' . call_user_func_array([$parameters, $functionName], []) . '&';
                }
            }
            $string = substr($string, 0, -1);
        }
        return $string;
    }


    /**
     * Function returns empty array if error occurs.
     *
     * @param GoogleBooksAPIRequestParameters $parameters
     * @return array|\ReflectionProperty[]
     *
     */
    private function getPrivateClassFields(GoogleBooksAPIRequestParameters $parameters): array
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