<?php 

namespace App\GraphQL\Types;

use App\Models\User;
use Graphql\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => "User",
        'description' => "A User",
        'model' => User::class,
    ];

    public function fields() :array {

        $fields = [
            // Id Field
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => "This Is User Unique ID.",
                'alias' => "id",
            ],

            // Name Field
            'name' => [
                'type' => Type::string(),
                'description' => "This Is User Name.",
            ],

            // Email Field
            'email' => [
                'type' => Type::string(),
                'description' => "This Is User Email.",
                'resolve' => function($root, array $args){
                    return strtolower($root->email);
                }
            ]
        ];

        return $fields;
    }
}