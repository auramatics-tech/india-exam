<?php

use App\Models\Category;
use App\Models\Questioncategories;
use App\Models\Setting;

function productImagePath($image_name)
{
    echo "here";
}
if (!function_exists('get_all_category')) {
    function get_all_category()
    {
        $categories = Category::where('type', 'Category')->where('is_navbar', 1)->where('active', 1)->orderby('sort','ASC')->get();
        return $categories;
    }
}
if (!function_exists('get_category')) {
    function get_category($id)
    {
        $categories = Category::where('slug', $id)->first();
        return $categories;
    }
}
if (!function_exists('get_perent_cat')) {
    function get_perent_cat($id)
    {
        $categories = Category::where('id', $id)->first();
        if ($categories->type == 'Subcategory') {
            return $categories->parent_id;
        } elseif ($categories->type == 'Topics') {
            $perent = Category::where('id', $categories->parent_id)->first();
            return $perent->parent_id;
        }
    }
}

function get_family($id)
{
    $topic_parent = Category::where('id', $id)->first();
    if ($topic_parent->type == 'Subcategory2') {
        $data['subcategory2'] = $topic_parent;
        $data['subcategory1'] = Category::where('id', $topic_parent->parent_id)->where('type', 'Subcategory1')->first();
        $data['subcategory'] = Category::where('id', $data['subcategory1']->parent_id)->where('type', 'Subcategory')->first();
        $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
    } else if ($topic_parent->type == 'Subcategory1') {
        $data['subcategory1'] = $topic_parent;
        $data['subcategory'] = Category::where('id', $topic_parent->parent_id)->where('type', 'Subcategory')->first();
        $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
    } else if ($topic_parent->type == 'Subcategory') {
        $data['subcategory'] = $topic_parent;
        $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
    }
    return $data;
}


function next_question_id($ques_id, $topic_id, $next = '>')
{
    $question = Questioncategories::where(['question_id' => $ques_id, 'topic_id' => $topic_id])->first();
    if (isset($question->id)) {
        if ($next == '>')
            $order = 'asc';
        else
            $order = 'desc';

        $question = Questioncategories::where('topic_id', $topic_id)->where('question_id', $next, $question->question_id)->orderby('question_id', $order)->first();
    }
    $id = isset($question->question_id) ? $question->question_id : '';
    return $id;
}
function facebook_google_link()
{
    $data = array();
    $data['facebook'] = Setting::where('key', 'facebook')->first()->value;
    $data['google'] = Setting::where('key', 'google')->first()->value;
    $data['youtube'] = Setting::where('key', 'youtube')->first()->value;
    return $data;
}

function next_url($category)
{
    
    if ($category->type == 'Category') {
        $category1 = $category;
    } elseif ($category->type == 'Subcategory') {
        $parent = $category->get_parent_id;
        $category1 = $parent;
        $check_sub_cat = $category->subcategory1;
        if (count($check_sub_cat)) {
            $category2 = $category;
        } else {
            $first_topic = $category->topics;
            if (isset($first_topic[0]->id) && $first_topic[0]->id) {
                $category2 = $category;
                $category3 = $first_topic[0];
            }
        }
        $id = $category->id;
    } elseif ($category->type == 'Subcategory1') {
        $category2 = $category->get_parent_id;
        $category1 = $category2->get_parent_id;
        $check_sub_cat = $category->subcategory2;
        if (count($check_sub_cat)) {
            $category3 = $category;
        } else {
            $first_topic = $category->topics;
            if (isset($first_topic[0]->id) && $first_topic[0]->id) {
                $category1 = $category2;
                $category2 = $category;
                $category3 = $first_topic[0];
            }
        }
    } elseif ($category->type == 'Subcategory2') {
        $first_topic = $category->topics;
        $category3 = $category->get_parent_id;
        $category2 = $category3->get_parent_id;
        $category1 = $category2;
        $category2 = $category;
        if (isset($first_topic[0]->id) && $first_topic[0]->id) {
            $category3 = $first_topic[0];
        }
    } elseif ($category->type == 'Topics') {
        $category5 = $category;
        $category4 = $category->get_parent_id;
        if ($category4->type == 'Subcategory2') {
            $category3 = $category->get_parent_id;
            $category2 = $category3->get_parent_id;
            $category1 = $category2->get_parent_id;
            $category2 = $category3;
        } else {
            $category2 = $category4;
            $category1 = $category2->get_parent_id;
        }
        $category3 = $category;
    }
    $url = '';

    if (isset($category1->slug) && $category1->slug)
        $url = route('home.data', ['category1' => isset($category1->slug) ? $category1->slug : '', 'category2' => isset($category2->slug) ? $category2->slug : '', 'category3' => isset($category3->slug) ? $category3->slug : '','category4'=> isset($category4->slug) ? $category4->slug : '','category5'=>isset($category5->slug) ? $category5->slug : '']);
    return $url;
}
