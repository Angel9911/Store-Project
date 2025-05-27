<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{

    public function getBrands(): \LaravelIdea\Helper\App\Models\_IH_Brand_C|\Illuminate\Database\Eloquent\Collection|array
    {
        return Brand::all();
    }
}
