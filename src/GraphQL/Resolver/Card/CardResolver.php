<?php


namespace App\GraphQL\Resolver\Card;


use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardResolver implements ResolverInterface
{

    public function __invoke(Argument $args)
    {
        return Card::find($args->offsetGet('multiverseId'));
    }
}