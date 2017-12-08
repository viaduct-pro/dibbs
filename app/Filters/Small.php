<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(320, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}