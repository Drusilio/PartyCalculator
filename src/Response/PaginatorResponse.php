<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\Serializer\Annotation\Groups;

class PaginatorResponse
{
    private const LIST_GROUP = 'LIST';
    private const DEFAULT_GROUP = '*';

    public const ONLY_LIST_GROUP = [self::LIST_GROUP];
    public const ALL_GROUP = [self::DEFAULT_GROUP, self::LIST_GROUP];
    public const ONLY_DEFAULT_GROUP = [self::DEFAULT_GROUP];

    public function __construct(
        #[Groups(self::ONLY_LIST_GROUP)] private array $items,
        #[Groups(self::ONLY_LIST_GROUP)] private int $count,
    ) {
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
