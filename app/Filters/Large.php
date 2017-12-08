<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(2000, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}