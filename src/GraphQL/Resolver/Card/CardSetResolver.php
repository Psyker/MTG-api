<?php

namespace App\GraphQL\Resolver\Card;

use Cocur\Slugify\Slugify;
use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardSetResolver implements ResolverInterface
{

    public function __invoke(Card $card): ?string
    {
        return $card->set !== null ? strtolower($card->set) : null;
    }
}
