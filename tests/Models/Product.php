<?php

namespace N7olkachev\AttributesSchema\Test\Models;

use Illuminate\Database\Eloquent\Model;
use N7olkachev\AttributesSchema\Attribute;
use N7olkachev\AttributesSchema\AttributesSchema;

class Product extends Model
{
    use AttributesSchema;

    public function attributesSchema()
    {
        return [
            'name' => Attribute::fillable()->default('Dummy title'),
            'description' => Attribute::fillable()->rules('min:10|max:255'),
            'guarded' => Attribute::guarded(),
        ];
    }
}