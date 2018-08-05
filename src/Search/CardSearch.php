<?php


namespace App\Search;


use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Argument;

class CardSearch
{
    /**
     * @param Argument $args
     * @return array|Card
     */
    public function search(Argument $args): array
    {
        [$multiverseId, $name, $colors, $types, $subtypes, $page, $pageSize] = [
            $args->offsetGet('multiverseId'),
            $args->offsetGet('name'),
            $args->offsetGet('colors'),
            $args->offsetGet('types'),
            $args->offsetGet('subtypes'),
            $args->offsetGet('page'),
            $args->offsetGet('pageSize')
        ];

        if ($multiverseId) {
            return [Card::find($multiverseId)];
        }

        return Card::where(compact('name', 'colors', 'types', 'subtypes', 'page', 'pageSize'))->all();
    }
}
