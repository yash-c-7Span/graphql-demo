<?php

namespace App\GraphQL\Query\User;

use App\Models\User;
use App\Services\UserService;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class Collection extends Query
{

    protected $attributes = [
        'name' => "users",
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('UserType'));
    }

    public function args(): array
    {
        return [
            'filters' => [
                'name' => "filters",
                'type' => GraphQL::type('UserFilter'),
            ],
            'search' => [
                'name' => "search",
                'type' => Type::string(),
            ],
            'sort' => [
                'name' => "sort",
                'type' => GraphQL::type('Sort'),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $userService = new UserService;
        $query = $userService->collection($args);
        return $query;
    }
}