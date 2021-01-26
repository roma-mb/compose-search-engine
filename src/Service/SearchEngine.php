<?php

namespace  App\Service;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class SearchEngine
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var Crawler
     */
    private $crawler;
    /**
     * @var string
     */
    private $selector;
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $url;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function setSelector(string $selector): SearchEngine
    {
        $this->selector = $selector;
        return $this;
    }

    public function setMethod(string $method): SearchEngine
    {
        $this->method = $method;
        return $this;
    }

    public function setUrl(string $url): SearchEngine
    {
        $this->url = $url;
        return $this;
    }

    public function run(): array
    {
        $response = $this->client->request($this->method, $this->url);
        $html     = $response->getBody();

        $this->crawler->addHtmlContent($html);

        $courses = $this->crawler->filter($this->selector);
        $result = [];

        foreach ($courses as $course) {
            $result[] =  $course->textContent;
        }

        return $result;
    }
}
