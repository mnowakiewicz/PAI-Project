<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 28.10.18
 * Time: 11:55
 */

namespace GoogleBooksBundle\Model;


/**
 * Class AccessInfo
 * @package BookBundle\Model
 */
class AccessInfo
{
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $viewability;
    /**
     * @var boolean
     */
    private $embeddable;
    /**
     * @var boolean
     */
    private $publicDomain;
    /**
     * @var string
     */
    private $textToSpeechPermission;
    /**
     * @var Epub
     */
    private $epub;
    /**
     * @var Pdf
     */
    private $pdf;
    /**
     * @var string
     */
    private $webReaderLink;
    /**
     * @var string
     */
    private $accessViewStatus;
    /**
     * @var boolean
     */
    private $quoteSharingAllowed;

    /**
     * AccessInfo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $accessInfoData
     * @return AccessInfo
     */
    public static function create(array $accessInfoData): AccessInfo
    {
        $return = new AccessInfo();

        $return
            ->setCountry($accessInfoData["country"])
            ->setViewability($accessInfoData["viewability"])
            ->setEmbeddable($accessInfoData["embeddable"])
            ->setPublicDomain($accessInfoData["publicDomain"])
            ->setTextToSpeechPermission($accessInfoData["textToSpeechPermission"])
            ->setEpub(Epub::create($accessInfoData["epub"]))
            ->setPdf(Pdf::create($accessInfoData["pdf"]))
            ->setWebReaderLink($accessInfoData["webReaderLink"])
            ->setAccessViewStatus($accessInfoData["accessViewStatus"])
            ->setQuoteSharingAllowed($accessInfoData["quoteSharingAllowed"]);

        return $return;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return AccessInfo
     */
    public function setCountry(string $country): AccessInfo
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewability(): string
    {
        return $this->viewability;
    }

    /**
     * @param string $viewability
     * @return AccessInfo
     */
    public function setViewability(string $viewability): AccessInfo
    {
        $this->viewability = $viewability;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmbeddable(): bool
    {
        return $this->embeddable;
    }

    /**
     * @param bool $embeddable
     * @return AccessInfo
     */
    public function setEmbeddable(bool $embeddable): AccessInfo
    {
        $this->embeddable = $embeddable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublicDomain(): bool
    {
        return $this->publicDomain;
    }

    /**
     * @param bool $publicDomain
     * @return AccessInfo
     */
    public function setPublicDomain(bool $publicDomain): AccessInfo
    {
        $this->publicDomain = $publicDomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextToSpeechPermission(): string
    {
        return $this->textToSpeechPermission;
    }

    /**
     * @param string $textToSpeechPermission
     * @return AccessInfo
     */
    public function setTextToSpeechPermission(string $textToSpeechPermission): AccessInfo
    {
        $this->textToSpeechPermission = $textToSpeechPermission;
        return $this;
    }

    /**
     * @return Epub
     */
    public function getEpub(): Epub
    {
        return $this->epub;
    }

    /**
     * @param Epub $epub
     * @return AccessInfo
     */
    public function setEpub(Epub $epub): AccessInfo
    {
        $this->epub = $epub;
        return $this;
    }

    /**
     * @return Pdf
     */
    public function getPdf(): Pdf
    {
        return $this->pdf;
    }

    /**
     * @param Pdf $pdf
     * @return AccessInfo
     */
    public function setPdf(Pdf $pdf): AccessInfo
    {
        $this->pdf = $pdf;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebReaderLink(): string
    {
        return $this->webReaderLink;
    }

    /**
     * @param string $webReaderLink
     * @return AccessInfo
     */
    public function setWebReaderLink(string $webReaderLink): AccessInfo
    {
        $this->webReaderLink = $webReaderLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessViewStatus(): string
    {
        return $this->accessViewStatus;
    }

    /**
     * @param string $accessViewStatus
     * @return AccessInfo
     */
    public function setAccessViewStatus(string $accessViewStatus): AccessInfo
    {
        $this->accessViewStatus = $accessViewStatus;
        return $this;
    }

    /**
     * @return bool
     */
    public function isQuoteSharingAllowed(): bool
    {
        return $this->quoteSharingAllowed;
    }

    /**
     * @param bool $quoteSharingAllowed
     * @return AccessInfo
     */
    public function setQuoteSharingAllowed(bool $quoteSharingAllowed): AccessInfo
    {
        $this->quoteSharingAllowed = $quoteSharingAllowed;
        return $this;
    }


}