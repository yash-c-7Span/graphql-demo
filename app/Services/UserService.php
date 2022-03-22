<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function collection($input)
    {
        $query = $this->user->query();
        $filters = isset($input['filters']) ? $input['filters'] : [];

        if(!empty($filters)){
            if (isset($filters['id'])) {
                $query = $query->where('id', $filters['id']);
            }
    
            if (isset($filters['name'])) {
                $name = $filters['name'];
                $query = $query->where('name', "LIKE", "%$name%");
            }
    
            if (isset($filters['email'])) {
                $query = $query->where('email', $filters['email']);
            }
        }

        if(isset($input['search'])){
            $query = $query->Search($input['search']);
        }

        if(isset($input['sort'])){
            $query = $query->orderBy();
        }

        $query = $query->get();
        return $query;
    }

    public function resource($id)
    {
        $query = $this->user->findOrFail($id);
        return $query;
    }

    public function upsert($input)
    {
        $id = isset($input['id']) ? $input['id'] : null;
        $input = isset($input['input']) ? $input['input'] : [];

        if (isset($id)) {
            $user = $this->resource($id);
            $user->update([
                'name' => isset($input['name']) ? $input['name'] : null,
                'email' => isset($input['email']) ? $input['email'] : null,
                'password' => isset($input['password']) ? $input['password'] : null,
            ]);

            return $user;
        }

        $user = $this->user->create([
            'name' => isset($input['name']) ? $input['name'] : null,
            'email' => isset($input['email']) ? $input['email'] : null,
            'password' => isset($input['password']) ? $input['password'] : null,
        ]);

        return $user;
    }

    public function delete($id){
        $user = $this->resource($id);
        $user->delete();
        return true;
    }
}
