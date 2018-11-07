<?php


namespace App\Search;


use GraphQL\Error\UserError;
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
        [$multiverseId, $set, $name, $number] = [
            $args->offsetGet('multiverseId'),
            $args->offsetGet('set'),
            $args->offsetGet('name'),
            $args->offsetGet('number')
        ];

        if ($multiverseId) {
            return Card::find($multiverseId);
        }

        if (!$set || !$name || !$number) {
            throw new UserError('You must either supply a multiverse ID, or a set and slug and a card number');
        }

        return $this->findOneby(compact('set', 'name', 'number'));
    }

    public function findOneby(array $arguments)
    {
        $all = Card::where($arguments)->all();

        return \count($all) > 0 ? $all[0] : null;
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
