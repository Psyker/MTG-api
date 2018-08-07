<?php

namespace App\GraphQL\Resolver\Card;

use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Ramsey\Uuid\Uuid;

class CardIdResolver implements ResolverInterface
{
    /**
     * @param Card $card
     * @return string
     * @throws \Exception
     */
    public function __invoke(Card $card): string
    {
        return Uuid::uuid5(
            Uuid::NAMESPACE_DNS,
            ($card->name ?? '') . ($card->imageUrl ?? '') . ($card->id ?? '')
        )->toString();
    }
}
