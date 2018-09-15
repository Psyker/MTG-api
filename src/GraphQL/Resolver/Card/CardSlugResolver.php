<?php

namespace App\GraphQL\Resolver\Card;

use Cocur\Slugify\Slugify;
use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardSlugResolver implements ResolverInterface
{

    public function __invoke(Card $card): ?string
    {
        return $card->name !== null ? (new Slugify())->slugify($card->name) : null;
    }
}
