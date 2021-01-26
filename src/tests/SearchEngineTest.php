<?php

namespace App\tests;

use App\Service\SearchEngine;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class SearchEngineTest extends TestCase
{
    private $clientMock;
    private $url = 'test-url';

    protected function setUp(): void
    {
        $html = file_get_contents(__DIR__ . '/index_test.html');

        $stream = $this->createMock(StreamInterface::class);
            $stream->expects(self::once())
                ->method('__toString')->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn($stream);

        $client = $this->createMock(ClientInterface::class);

        $client->expects(self::once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->clientMock = $client;
    }

    /** @test */
    public function shouldReturnCourses(): void
    {
        $crawler      = new Crawler();
        $searchEngine = (new SearchEngine($this->clientMock, $crawler))
            ->setMethod('GET')
            ->setSelector('span.card-curso__nome')
            ->setUrl($this->url)
            ->run();

        $this->assertCount(3, $searchEngine);
        $this->assertEquals('Curso Teste 1', $searchEngine[0]);
        $this->assertEquals('Curso Teste 2', $searchEngine[1]);
        $this->assertEquals('Curso Teste 3', $searchEngine[2]);
    }
}
