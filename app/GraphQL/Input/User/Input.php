<?php

namespace App\GraphQL\Input\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class Input extends InputType
{
    protected $attributes = [
        'name' => "UserInput",
        'description' => "User updare Input",
        'model' => User::class,
    ];
    public function fields() :array
    {
        $inputs = [
            'name' => [
                'name' => "name",
                'type' => Type::string(),
                'rules' => [
                    "required"
                ]
            ],
            'email' => [
                'name' => "email",
                'type' => Type::string(),
                'rules' => function($inputArguments, $mutationArguments){
                    $id = isset($mutationArguments['id']) ? $mutationArguments['id'] : null;
                    $rules = [
                        "required",
                        "email",
                        "unique:users,email,$id"
                    ];
                    return $rules;
                }
            ],
            'password' => [
                'name' => "password",
                'type' => Type::string(),
                'rules' => [
                    "required",
                    "min:8",
                ]
            ]
        ];
        return $inputs;
    }
}
