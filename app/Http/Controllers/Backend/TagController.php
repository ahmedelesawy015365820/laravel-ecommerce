<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Repositery\Tag\TagInterfaceRepositry;
use Illuminate\Http\Request;

class TagController extends Controller
{

    protected $tag;


    function __construct(TagInterfaceRepositry $tag){

        $this->tag = $tag;

        $this->middleware('permission:tag-list', ['only' => ['index']]);
        $this->middleware('permission:tag-create', ['only' => ['create','store']]);
        $this->middleware('permission:tag-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        return $this->tag->index($request);
    }


    public function store(TagRequest $request)
    {
        return $this->tag->store($request);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        return $this->tag->update($request, $tag);
    }

    public function destroy(Request $request)
    {
        return $this->tag->destroy($request);
    }
}
