<?php

namespace App\GraphQL\Query;

use App\Models\User;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected $attributes = [
        'name' => "users",
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('User'))));
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
        if(isset($args['id'])){
            $query = $this->user->find($args['id']);
            return $query;
        }

        if(isset($args['name'])){
            $name = $args['name'];
            $query = $this->user->where('name', "LIKE", "%{$name}%")->get();
            return $query;
        }

        if(isset($args['email'])){
            $query = $this->user->where('email', $args['email'])->get();
            return $query;
        }

        $query = $this->user->all();
        return $query;
    }
}
