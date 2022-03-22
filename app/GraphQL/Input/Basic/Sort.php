<?php 

namespace App\GraphQL\Input\Basic;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class Sort extends InputType {

    protected $attributes = [
        'name' => "Sort",
        'description' => 'Sorting order for Model.',
    ];

    public function fields() :array {
        $fields = [
            'by' => [
                'name' => "by",
                'type' => Type::string(),
                'description' => "The name of column which will be used for sorting the data.",
                'rules' => [
                    "required",
                ],
            ],
            'order' => [
                'name' => "order",
                'type' => Type::string(),
                'description' => "The order of sorting. It should be either `asc` or `desc`(Default).",
                'defaultValue' => "desc",
                'always' => [
                    "asc",
                    "desc"
                ]
            ]
        ];
        return $fields;
    }
}