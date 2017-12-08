<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Origin implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(5000, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}