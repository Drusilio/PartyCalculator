<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestDeserializerInterface
{
    public function deserialize(Request $request, string $type): mixed;
}
