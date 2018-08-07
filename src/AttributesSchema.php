<?php

namespace N7olkachev\AttributesSchema;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

trait AttributesSchema
{
    /**
     * Attributes schema.
     *
     * @return Attribute[]
     */
    abstract protected function attributesSchema();

    /**
     * Override constructor for setting default attributes.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($this->attributesSchema() as $key => $attribute) {
            if ($attribute->hasDefault() && !isset($attributes[$key])) {
                $attributes[$key] = $attribute->getDefault();
            }

            if ($attribute->shouldBeValidated()) {
                $validator = resolve('validator')->make(
                    [$key => $attributes[$key] ?? null],
                    [$key => $attribute->rules()],
                    []
                );
                $validator->validate();
            }
        }

        parent::__construct($attributes);
    }

    /**
     * Override fillables with fillable attributes.
     *
     * @return array
     */
    public function getFillable()
    {
        return array_merge(parent::getFillable(), array_keys($this->getFillableAttributesFromSchema()));
    }

    /**
     * Find fillable attributes
     *
     * @return array
     */
    protected function getFillableAttributesFromSchema()
    {
        return array_filter($this->attributesSchema(), function (Attribute $attribute) {
            return $attribute->isFillable();
        });
    }

    /**
     * Check if attribute is in attributes schema.
     *
     * @param string $attribute
     * @return bool|Attribute
     */
    protected function attributeIsInSchema($attribute)
    {
        return isset($this->attributesSchema()[$attribute]);
    }

    public function setAttribute($key, $value)
    {
        if ($this->attributeIsInSchema($key)) {
            $attribute = $this->attributesSchema()[$key];
            if ($attribute->shouldBeValidated()) {
                $validator = resolve('validator')->make(
                    [$key => $value],
                    [$key => $attribute->rules()],
                    []
                );
                $validator->validate();
            }
        }

        return parent::setAttribute($key, $value);
    }
}