<?php

declare(strict_types=1);

namespace Orion\ValueObjects\Specs\Responses;

use Orion\ValueObjects\Specs\Response;

class CollectionResponse extends Response
{
    public $statusCode = 200;
    public $description = 'OK';
    public $resourceComponentBaseName;

    public function __construct(string $resourceComponentBaseName)
    {
        $this->resourceComponentBaseName = $resourceComponentBaseName;
    }

    // TODO: move links and meta definitions to components
    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'data' => [
                                    'type' => 'array',
                                    'items' => [
                                        '$ref' => "#/components/schemas/{$this->resourceComponentBaseName}Resource",
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
