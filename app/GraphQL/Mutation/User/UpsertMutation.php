<?php

namespace App\GraphQL\Mutation\User;

use App\Models\User;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Mutation;
use App\GraphQL\Input\User\Input as UserInput;
use App\Services\UserService;

class UpsertMutation extends Mutation
{

    protected $attributes = [
        'name' => 'userCreate'
    ];

    public function type(): Type
    {
        return GraphQl::type('UserType');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => "id",
                'type' => Type::int(),
            ],
            'input' => [
                'name' => 'input',
                'type' => GraphQL::type('UserInput'),
                'rules' => "required"
            ]
        ];
    }


    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $userService = new UserService;
        $user = $userService->upsert($args);

        return $user;
    }
}
