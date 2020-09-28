<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::paginate(15);
        return view('Category.index',compact('category'));
    }
}
