<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'images'
    ];

    public function transform(User $user)
    {
        $tmp = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        return $tmp;
    }

    public function includeImages(User $user)
    {
        return $this->collection($user->images, new ImageTransformer);
    }
}