<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Image;

class ImageTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(Image $image)
    {
        $tmp = [
            'id' => $image->id,
            'name' => $image->name
        ];
        return $tmp;
    }
}