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
use BookBundle\Entity\Enum\StatusEnum;
use BookBundle\Entity\PrintType;
use CategoryBundle\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use GoogleBooksBundle\Model\GoogleApiResponse;
use GoogleBooksBundle\Options\Enum\FilterEnum;
use GoogleBooksBundle\Options\Enum\LibraryRestrictEnum;
use GoogleBooksBundle\Options\Enum\OrderByEnum;
use GoogleBooksBundle\Options\Enum\PrintTypeEnum;
use GoogleBooksBundle\Options\Enum\ProjectionEnum;
use GoogleBooksBundle\Options\GoogleBooksParameters;
use ImageBundle\Entity\Image;
use Monolog\Logger;
use PublisherBundle\Entity\Publisher;
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
     * @param GoogleBooksParameters $parameters
     * @return GoogleApiResponse
     */
    public function getMappedResponseModel(GoogleBooksParameters $parameters ):GoogleApiResponse
    {
        $url = $this->createUrl($this->parametersToString($parameters));

        $this->logger->info('Sending list request to GoogeApiBooks', [
            'url' => $url,
        ]);

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $response = json_decode($response->getBody()->getContents(), true);
        return GoogleApiResponse::create($response);
    }

    /**
     * Creates URL,
     * example https://www.googleapis.com/books/v1/volumes?q={value}$key={googleApiKey}
     *
     * @param string $parameters
     * @return string
     */
    private function createUrl(string $parameters) : string
    {

        $url = 'https://www.googleapis.com/books/v1/volumes?';
        $url .=
            $parameters .
            "&key=" .
            $this->container->getParameter('googleApiKey');

        return $url;
    }

    /**
     * Returns string in a format {parameter1}={value1}&{parameter2}={value2}&...{parameterN}={valueN}
     *
     * @param GoogleBooksParameters $parameters
     * @return string
     */
    private function parametersToString(GoogleBooksParameters $parameters): string
    {
        $fields = $this->getPrivateClassFields($parameters);

        $string = '';
        if (count($fields)) {
            for ($i = 0; $i < count($fields); $i++) {

                $functionName = 'get' . ucfirst($fields[$i]->getName());
                $functionValue = call_user_func_array([$parameters, $functionName], []);

                if ($functionValue != null) {
                    $string .= $fields[$i]->getName() . '=' . $functionValue . '&';
                }
            }
            $string = substr($string, 0, -1);
        }
        return $string;
    }


    /**
     * Function returns empty array if error occurs.
     *
     * @param GoogleBooksParameters $parameters
     * @return array|\ReflectionProperty[]
     *
     */
    private function getPrivateClassFields(GoogleBooksParameters $parameters): array
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

        try {
            $operator = $repository->getOperatorByUsername($username);
        } catch (NoResultException | NonUniqueResultException $e) {
            $this->logger->error("Couldn't fetch Operator from Data Base", [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            $operator = null;
        }

        foreach ($apiResponse->getItems() as $item){
            $book = new Book();

            $volumeInfo = $item->getVolumeInfo();
            $accessInfo = $item->getAccessInfo();

            $authors = new ArrayCollection();

            foreach ($volumeInfo->getAuthors() as $author){
                $authors->add(new Author($author));
            }

            $categories = new ArrayCollection();
            if ($volumeInfo->getCategories() != null){
                foreach ($volumeInfo->getCategories() as $category){
                    $categories->add(new Category($category));
                }
            }

            $image = new Image($volumeInfo->getTitle());

            $image
                ->setThumbnail($volumeInfo->getImageLinks()->getThumbnail())
                ->setSmallThumbnail($volumeInfo->getImageLinks()->getSmallThumbnail());

            $book
                ->setGoogleId($item->getId())
                ->setEtag($item->getEtag())
                ->setTitle($volumeInfo->getTitle())
                ->setSubtitle($volumeInfo->getSubtitle())
                ->setPublishedDate($volumeInfo->getPublishedDate())
                ->setDescription($volumeInfo->getDescription())
                ->setPageCount($volumeInfo->getPageCount())
                ->setLanguage($volumeInfo->getLanguage())
                ->setWebReaderLink($accessInfo->getWebReaderLink())
                ->setAuthors($authors)
                ->setPrintType(new PrintType($volumeInfo->getPrintType()))
                ->setImage($image)
                ->setCreator($operator)
                ->setStatus(StatusEnum::DRAFT())
                ->setCategories($categories);

            if($volumeInfo->getPublisher()){
                $book->setPublisher(new Publisher($volumeInfo->getPublisher()));
            }

            $books[] = $book;
        }
        return $books;
    }

    /**
     * @param array $form
     * @return GoogleBooksParameters
     */
    public function mapFormToGoogleBookParameters(array $form):GoogleBooksParameters
    {
        $googleParams = new GoogleBooksParameters($form['q']);

        try {
            $reflection = new \ReflectionClass($googleParams);
        } catch (\ReflectionException $e) {
            $this->logger->error('Error occurred while reflecting class', [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $googleParams;
        }

        $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($props as $prop){
            $propName = $prop->getName();

            if(array_key_exists($propName, $form) && $form[$propName] != null ){
                $functionName = 'set' . ucfirst($prop->getName());
                $data = $form[$propName];

                switch ($propName){
                    case 'filter':
                        call_user_func_array([$googleParams, $functionName], [new FilterEnum($data)]);
                        break;
                    case 'libraryRestrict':
                        call_user_func_array([$googleParams, $functionName], [new LibraryRestrictEnum($data)]);
                        break;
                    case 'orderBy':
                        call_user_func_array([$googleParams, $functionName], [new OrderByEnum($data)]);
                        break;
                    case 'printType':
                        call_user_func_array([$googleParams, $functionName], [new PrintTypeEnum($data)]);
                        break;
                    case 'projection':
                        call_user_func_array([$googleParams, $functionName], [new ProjectionEnum($data)]);
                        break;
                    default:
                        call_user_func_array([$googleParams, $functionName], [$data]);
                }
            }
        }

        return $googleParams;
    }

}