<?php

use Illuminate\Support\HtmlString;

function categoriesSelect($categories, $lvl = 0)
{
    $out = "";

    foreach ($categories as $category) {

        if ($category->parent_id == 0) {
            $out .= '<optgroup label="' . $category->name . '">';
        } else {
            $out .= '<option value="' . $category->id . '">' . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $lvl-1) . $category->name . '</option>';
        }
        
        if (count($category->children)) {
            $out .=  categoriesSelect($category->children, $lvl+1);
        }

        if ($category->parent_id == 0) {
            $out .= '</optgroup>';
        }
    }
    return $out;
}

function FormCategorySelect()
{
    return new HtmlString(categoriesSelect(App\Category::main()->get()));
}