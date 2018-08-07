<?php


namespace App\GraphQL\Resolver\Card;


use App\Search\CardSearch;
use mtgsdk\Card;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CardResolver implements ResolverInterface
{
    /**
     * @var CardSearch
     */
    private $cardSearch;

    public function __construct(CardSearch $cardSearch)
    {

        $this->cardSearch = $cardSearch;
    }

    public function __invoke(Argument $args): Card
    {
        return $this->cardSearch->searchOne($args);
    }
}
