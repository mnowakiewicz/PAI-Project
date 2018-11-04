<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 19:24
 */

namespace GoogleBooksBundle\Service;

use AuthorBundle\Entity\Author;
use BookBundle\Entity\Book;
use BookBundle\Entity\PrintType;
use Doctrine\ORM\EntityManager;
use GoogleBooksBundle\Model\GoogleApiResponse;
use GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters;
use ImageBundle\Entity\Image;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * GoogleBooksService constructor.
     * @param ContainerInterface $container
     * @param Logger $logger
     * @param TokenStorage $tokenStorage
     * @param EntityManager $entityManager
     */
    public function __construct(ContainerInterface $container, Logger $logger, TokenStorage $tokenStorage, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->logger = $logger;
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
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


    /**
     * @param GoogleApiResponse $apiResponse
     * @return Book[]
     */
    public function createBookObjectsFromMappedModel(GoogleApiResponse $apiResponse):array
    {
        $books = [];
        $username = $this->tokenStorage->getToken()->getUsername();
        $repository = $this->entityManager->getRepository('OperatorBundle:Operator');

        $operator = $repository->getOperatorByUsername($username);

        foreach ($apiResponse -> getItems() as $item){
            $book = new Book($operator, $item->getId(), $item->getEtag());
            $volumeInfo = $item->getVolumeInfo();
            $accessInfo = $item->getAccessInfo();

            $authors = [];
            foreach ($volumeInfo->getAuthors() as $author){
                $authors[] = new Author($author);
            }

            $image = new Image($volumeInfo->getTitle());

            $image
                ->setThumbnail($volumeInfo->getImageLinks()->getThumbnail())
                ->setSmallThumbnail($volumeInfo->getImageLinks()->getSmallThumbnail());

            $book
                ->setTitle($volumeInfo->getTitle())
                ->setSubtitle($volumeInfo->getSubtitle())
                ->setPublishedDate($volumeInfo->getPublishedDate())
                ->setDescription($volumeInfo->getDescription())
                ->setPageCount($volumeInfo->getPageCount())
                ->setLanguage($volumeInfo->getLanguage())
                ->setWebReaderLink($accessInfo->getWebReaderLink())
                ->setAuthors($authors)
                ->setPrintType(new PrintType($volumeInfo->getPrintType()))
                ->setImage($image);

            $books[] = $book;

        }
        return $books;
    }
}