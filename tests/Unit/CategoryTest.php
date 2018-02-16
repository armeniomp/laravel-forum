<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    protected $category;

    public function setUp() 
    {
        parent::setUp();

        $this->category = create('App\Category');
    }
    public function testCategoryHasThreads()
    {
        $thread = create('App\Thread', ['category_id' => $this->category->id]);

        $this->assertTrue($this->category->threads->contains($thread));
    }

    public function testCategoryHasSubcategories()
    {
        $subcategory = create('App\Category', ['parent_id' => $this->category->id]);
        
        $this->assertTrue($this->category->children->contains($subcategory));
    }

    public function testSubcategoryBelongToCategory()
    {
        $subcategory = factory('App\Category')->states('subcategory')->create();

        $this->assertInstanceOf('App\Category', $subcategory->parent);
    }
}
