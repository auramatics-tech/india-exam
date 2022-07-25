<?php

use App\Models\Blog;
use App\Models\Category;
use App\Models\Questioncategories;
use App\Models\Setting;
use App\Models\MockTest;
use App\Models\BlogCategory;
// use App\Models\Category;

function productImagePath($image_name)
{
    echo "here";
}
if (!function_exists('get_all_category')) {
    function get_all_category()
    {
        $categories = Category::where('type', 'Category')->where('is_navbar', 1)->where('active', 1)->orderby('sort', 'ASC')->get();
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

function next_mock_test_id($mock_test_td, $subcat, $next = '>')
{
    $mock_test = MockTest::where(['id' => $mock_test_td, 'cat_id' => $subcat])->first();
    if (isset($mock_test->id)) {
        if ($next == '>')
            $order = 'asc';
        else
            $order = 'desc';

        $mock_test = MockTest::where('cat_id', $subcat)->where('id', $next, $mock_test->id)->orderby('id', $order)->first();
    }
    $id = isset($mock_test->id) ? $mock_test->id : '';
    return $id;
}

function facebook_google_link()
{
    $data = array();
    $data['facebook'] = Setting::where('key', 'facebook')->first()->value;
    $data['google'] = Setting::where('key', 'google')->first()->value;
    $data['youtube'] = Setting::where('key', 'youtube')->first()->value;
    $data['telegram'] = Setting::where('key', 'telegram')->first()->value;
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
        $url = route('home.data', ['category1' => isset($category1->slug) ? $category1->slug : '', 'category2' => isset($category2->slug) ? $category2->slug : '', 'category3' => isset($category3->slug) ? $category3->slug : '', 'category4' => isset($category4->slug) ? $category4->slug : '', 'category5' => isset($category5->slug) ? $category5->slug : '']);
    return $url;
}

function navbar()
{
    $categories = Category::where('type','Category')->where('active',1)->get();
    $html = '';

        foreach($categories as $key =>  $category)
        {
            $html.= '<li class="su_padding_nav_list">
            <a class="accordion-heading su_a_decoration su_color_Categories" data-toggle="collapse" data-target="#submenu'.$category->id.'">
            <i class="fa-solid fa-angles-right su_right_icon"></i>
                <span class="nav-header-primary ">'.$category->name.' <span class="pull-right"><b class="caret"></b></span></span>
            </a>
            <ul class="nav nav-list collapse" id="submenu'.$category->id.'">';
            $Subcategories = Category::where('type','Subcategory')->where('parent_id',$category->id)->where('active',1)->get(); 
            foreach( $Subcategories as $key2 => $subcategory)
            {
                $html.= '<li class="su_margin_subCategories">
                <a class="accordion-heading su_color_subCategories su_a_decoration" data-toggle="collapse" data-target="#submenu1'.$subcategory->id.'">
                <i class="fa-solid fa-angle-right su_right_icon_subCategories"></i> 
                '.$subcategory->name.'<span class="pull-right"><b class="caret"></b></span>
                </a> 
                    <ul class="nav nav-list collapse" id="submenu1'.$subcategory->id.'">';
                    $Subcategories1 = Category::where('type','Subcategory1')->where('parent_id',$subcategory->id)->where('active',1)->get();
                    if(count($Subcategories1))
                    {
                        foreach($Subcategories1 as $key3 => $subcategory1)
                        {
                            $html.= '<li class="su_margin_subCategories">
                                <a class="accordion-heading su_color_subCategories su_a_decoration" data-toggle="collapse" data-target="#submenu2'.$subcategory1->id.'">
                                <i class="fa-solid fa-angle-right su_right_icon_subCategories"></i> 
                                '.$subcategory1->name.'<span class="pull-right"><b class="caret"></b></span>
                                </a> 
                                    <ul class="nav nav-list collapse" id="submenu2'.$subcategory1->id.'">';
                                    $subcategories2 = Category::where('type','Subcategory2')->where('parent_id',$subcategory1->id)->where('active',1)->get();
                                    if(count($subcategories2))
                                    {
                                        foreach($subcategories2 as $key3 => $subcategory2)
                                        {
                                            
                                            $html.= '<li class="su_margin_subCategories">
                                            <a class="accordion-heading su_color_subCategories su_a_decoration" data-toggle="collapse" data-target="#topic'.$subcategory2->id.'">
                                            <i class="fa-solid fa-angle-right su_right_icon_subCategories"></i> 
                                            '.$subcategory2->name.'<span class="pull-right"><b class="caret"></b></span>
                                            </a> 
                                                <ul class="nav nav-list collapse" id="topic'.$subcategory2->id.'">';
                                                $topics = Category::where('type','Topics')->where('parent_id',$subcategory2->id)->where('active',1)->get();
                                                foreach($topics as $key3 => $topic)
                                                {
                                                    $question = $topic->first_question;
                                                    $question_id = isset($question->question_id) ? "?question_id=$question->question_id" : '' ;
                                                    $html.=  '<li class="su_margin_subCategories"><a class="su_color_heading su_a_decoration" href="'.route('admin.questioncat', $category->id) .$question_id .'" title="Title"><i class="fa-solid fa-caret-right su_right_icon_subCategories"></i>'.$topic->name.' </a></li>';
                                                }
                                                    $html.=  '</ul>
                                            </li>';
                                        }
                                    }
                                    else
                                    {
                                        $topics = Category::where('type','Topics')->where('parent_id',$subcategory1->id)->where('active',1)->get();
                                        foreach($topics as $key3 => $topic)
                                        {
                                            $question = $topic->first_question;
                                            $question_id = isset($question->question_id) ? "?question_id=$question->question_id" : '' ;
                                            $html.=  '<li class="su_margin_subCategories"><a class="su_color_heading su_a_decoration" href="'.route('admin.questioncat', $category->id) .$question_id .'" title="Title"><i class="fa-solid fa-caret-right su_right_icon_subCategories"></i>'.$topic->name.' </a></li>';
                                        }
                                    }
                                    
                                        $html.=  '</ul>
                                </li>';
                        }
                    }
                    else
                    {
                        $topics = Category::where('type','Topics')->where('parent_id',$subcategory->id)->where('active',1)->get();
                        foreach($topics as $key3 => $topic)
                        {
                            $question = $topic->first_question;
                            $question_id = isset($question->question_id) ? "?question_id=$question->question_id" : '' ;
                            $html.=  '<li class="su_margin_subCategories"><a class="su_color_heading su_a_decoration" href="'.route('admin.questioncat', $category->id) .$question_id .'" title="Title"><i class="fa-solid fa-caret-right su_right_icon_subCategories"></i>'.$topic->name.' </a></li>';
                        }
                    }
                    
                        $html.=  '</ul>
                </li>';
            }
            $html.= '</ul>
        </li>';
        }
    return $html;
}

if (!function_exists('jobsinstate')) {
    function jobsinstate($state)
    {
        $blogs = array();
        $blogs = Blog::where('state', $state)->get();
        return $blogs;
    }
}
if (!function_exists('jobsinblogcat')) {
    function jobsinblogcat($cat)
    {
        $blogs = array();
        $blogs = Blog::where('blog_cat_id', $cat)->get();
        return $blogs;
    }
}
