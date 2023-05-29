<?php

namespace App\ArgumentResolver;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class AttributeArgument
{
    public function __construct()
    {
    }
}
