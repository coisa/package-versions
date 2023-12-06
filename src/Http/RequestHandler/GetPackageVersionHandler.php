<?php declare(strict_types=1);
/**
 * @author Felipe Sayão Lobato Abreu <contato@felipeabreu.com.br>
 * @package CoiSA\Versions\Http\RequestHandler
 */

namespace CoiSA\PackageVersions\Http\RequestHandler;

use PackageVersions\Versions;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class GetPackageVersionHandler
 *
 * @package CoiSA\PackageVersions\Http\RequestHandler
 */
final class GetPackageVersionHandler implements RequestHandlerInterface
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var array
     */
    private $versions;

    /**
     * GetPackageVersionsHandler constructor.
     *
     * @param ResponseFactoryInterface $responseFactory
     * @param StreamFactoryInterface $streamFactory
     * @param array $versions
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory,
        array $versions = Versions::VERSIONS
    ) {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        $this->versions = $versions;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$request->get) {

        }

        $response = $this->responseFactory->createResponse(200, 'OK');
        $stream = $this->streamFactory->createStream(\json_encode($this->versions));

        return $response->withBody($stream);
    }
}
