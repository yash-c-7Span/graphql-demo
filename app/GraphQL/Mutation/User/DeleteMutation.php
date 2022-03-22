<?php

namespace App\GraphQL\Mutation\User;

use App\Models\User;
use App\Services\UserService;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{

    private User $user;

    public function __construct()
    {
    }
    protected $attributes = [
        'name' => "UserDelete"
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::boolean());
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => "id",
                'type' => Type::int(),
                'rules' => [
                    "required",
                    "exists:users,id",
                ]
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $id = isset($args['id']) ? $args['id'] : null;
        $userService = new UserService;
        $user = $userService->delete($id);
        return $user;
    }
}
