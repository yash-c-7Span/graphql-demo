<?php

namespace App\GraphQL\Query\User;

use App\Models\User;
use App\Services\UserService;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class Resource extends Query
{

    protected $attributes = [
        'name' => "user",
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('UserType'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => "id",
                'type' => Type::int(),
            ],
            'name' => [
                'name' => "name",
                'type' => Type::string(),
            ],
            'email' => [
                'name' => "email",
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $id = isset($args['id']) ? $args['id'] : null;
        $userService = new UserService;
        $user = $userService->resource($id);
        return $user;
    }
}
