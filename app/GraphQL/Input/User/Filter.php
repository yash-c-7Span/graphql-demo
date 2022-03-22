<?php 

namespace App\GraphQL\Input\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class Filter extends InputType {
    protected $attributes = [
        'name' => "UserFilter",
        'description' => "Filter For Users",
    ];

    public function fields() :array {
        $inputs =  [
            'name' => [
                'name' => "name",
                'type' => Type::string(),
            ],
            'email' => [
                'name' => "email",
                'type' => Type::string(),
            ]
        ];

        return $inputs;
    }
}