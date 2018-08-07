<?php

namespace N7olkachev\AttributesSchema\Test;


use Illuminate\Validation\ValidationException;
use N7olkachev\AttributesSchema\Test\Models\Product;
use Orchestra\Testbench\TestCase;

class AttributesSchemaTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function it_works_for_defaults()
    {
        $product = new Product(['description' => 'Valid description']);
        $this->assertEquals('Dummy title', $product->name);
        $product = new Product(['name' => 'custom', 'description' => 'Valid description']);
        $this->assertEquals('custom', $product->name);
    }

    /** @test */
    public function it_works_for_validation_on_construct()
    {
        $this->expectException(ValidationException::class);
        $product = new Product(['description' => 'short']);
    }

    /** @test */
    public function it_works_for_validation_without_default_attributes()
    {
        $this->expectException(ValidationException::class);
        $product = new Product();
    }

    /** @test */
    public function it_works_for_validation_on_setter()
    {
        $product = new Product(['description' => 'Valid description']);
        $this->expectException(ValidationException::class);
        $product->description = 'short';
    }

    /** @test */
    public function it_works_with_guarded_attributes()
    {
        $product = new Product(['guarded' => 'fail', 'description' => 'Valid description']);
        $this->assertNull($product->guarded);
    }
}