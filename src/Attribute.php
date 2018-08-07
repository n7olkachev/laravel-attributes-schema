<?php

namespace N7olkachev\AttributesSchema;

use phpDocumentor\Reflection\Types\Null_;

class Attribute
{
    /**
     * Indicates if attribute is fillable.
     *
     * @var bool
     */
    protected $fillable;

    /**
     * Default attribute value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * Attribute validation rules.
     *
     * @var mixed
     */
    protected $rules;

    /**
     * Attribute constructor.
     *
     * @param $fillable
     */
    protected function __construct($fillable)
    {
        $this->fillable = $fillable;
    }

    /**
     * Create fillable attribute.
     *
     * @return Attribute
     */
    public static function fillable()
    {
        return new self(true);
    }

    /**
     * Create guarded attribute.
     *
     * @return Attribute
     */
    public static function guarded()
    {
        return new self(false);
    }

    /**
     * Check if attribute is fillable.
     *
     * @return bool
     */
    public function isFillable()
    {
        return $this->fillable;
    }

    /**
     * Set default value.
     *
     * @param $value
     * @return $this
     */
    public function default($value)
    {
        $this->default = $value;

        return $this;
    }

    /**
     * Check if attribute has default value.
     * @return bool
     */
    public function hasDefault()
    {
        return $this->default !== null;
    }

    /**
     * Get default value.
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Get or set attribute validation rules.
     *
     * @param $rules
     * @return $this
     */
    public function rules($rules = null)
    {
        if (!$rules) {
            return $this->rules;
        }

        $this->rules = $rules;

        return $this;
    }

    /**
     * Check if attribute should be validated.
     *
     * @return bool
     */
    public function shouldBeValidated()
    {
        return $this->rules !== null;
    }
}
