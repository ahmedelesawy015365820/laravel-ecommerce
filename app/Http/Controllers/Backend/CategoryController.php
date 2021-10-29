<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositery\Category\CategoryInterfaceRepositry;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $Category;


    function __construct(CategoryInterfaceRepositry $Category){

        $this->Category = $Category;

        $this->middleware('permission:Category-list', ['only' => ['index']]);
        $this->middleware('permission:Category-create', ['only' => ['create','store']]);
        $this->middleware('permission:Category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Category-delete', ['only' => ['destroy']]);

    }


    public function index(Request $request)
    {
        return $this->Category->index($request);
    }


    public function store(CategoryRequest $request)
    {
        return $this->Category->store($request);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return $this->Category->update($request, $category);
    }

    public function destroy(Request $request)
    {
        return $this->Category->destroy($request);
    }
}
