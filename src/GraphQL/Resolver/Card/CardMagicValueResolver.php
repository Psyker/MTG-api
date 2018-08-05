<?php


namespace App\GraphQL\Resolver\Card;


use GraphQL\Type\Definition\ResolveInfo;
use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardMagicValueResolver implements ResolverInterface
{
    public function __invoke(Card $card, ResolveInfo $resolveInfo)
    {
        if (!isset($card->{$resolveInfo->fieldName})) {
            return null;
        }

        return $card->{$resolveInfo->fieldName};
    }

}