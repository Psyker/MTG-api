<?php


namespace App\Search;


use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Argument;

class CardSearch
{
    /**
     * @param Argument $args
     * @return Card|null
     */
    public function searchOne(Argument $args): ?Card
    {
        $multiverseId = $args->offsetGet('multiverseId');

        return Card::find($multiverseId);
    }

    /**
     * @param Argument $args
     * @return Card[]|array
     */
    public function searchAll(Argument $args): array
    {
        [$name, $colors, $types, $subtypes, $page, $pageSize] = [
            $args->offsetGet('name'),
            $args->offsetGet('colors'),
            $args->offsetGet('types'),
            $args->offsetGet('subtypes'),
            $args->offsetGet('page'),
            $args->offsetGet('pageSize')
        ];

        ++$pageSize;

        $items = Card::where(compact('name', 'colors', 'types', 'subtypes', 'page', 'pageSize'))->all();
        $hasMore = isset($items[$pageSize - 1]);
        unset($items[$pageSize - 1]);

        return compact('items', 'hasMore') ;
    }
}
