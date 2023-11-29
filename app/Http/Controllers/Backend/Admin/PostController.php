<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\PostService;

use Illuminate\Http\Request;

use View;

use Yajra\DataTables\DataTables;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;
    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request){
        return view('backend.admin.post.index');
    }

    public function getAll(Request $request)
    {
        $posts = $this->postService->getAll();
        return Datatables::of($posts)
            ->addColumn('status', function ($post) {
                return $post->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->addColumn('action', function ($post){
                $html = '<div class="btn-group">';
                $html .= '<a href="'. route('admin.posts.edit', $post) .'" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
                $html .= '<a id="'. $post->id .'" class="btn btn-xs btn-danger delete" title="Delete"><i class="fa fa-trash"></i> </a>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('category', function ($post){
                return $post->category ? $post->category->title : '---';
            })
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }

    public function create(Request $request){
        $categoryList = $this->categoryService->getAll()->pluck('title', 'id')->toArray();
        return view('backend.admin.post.create', ['categoryList' => $categoryList] );
    }

    public function createPost(Request $request){
        $CPDTO = new CreatePostDTO(
            $request->user()->id,
            $request->title,
            $request->description,
            $request->status,
            $request->category
        );
        $this->postService->create($CPDTO);
        return redirect('/admin/posts');
    }

    public function edit(Request $request, $id){
        $post = $this->postService->getByID($id);
        $categoryList = $this->categoryService->getAll()->pluck('title', 'id')->toArray();
        return view('backend.admin.post.edit', ['post' => $post, 'categoryList' => $categoryList]);
    }

    public function editPost(Request $request){
        $UPDTO = new UpdatePostDTO(
            $request->id,
            $request->user()->id,
            $request->title,
            $request->description,
            $request->status,
            $request->category
        );
        $this->postService->update($UPDTO);
        return redirect('/admin/posts');
    }

    public function destroy($id, Request $request){
        $this->postService->delete($id);
        return ['type' => 'success'];
    }
}
