<?php

namespace App\GraphQL\Resolver\Card;

use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardsResolver implements ResolverInterface
{
    public function __invoke(Argument $args)
    {
        return Card::where(
            [
                'page' => $args->offsetGet('page'),
                'pageSize' => $args->offsetGet('pageSize')
            ])->all();
    }
}
