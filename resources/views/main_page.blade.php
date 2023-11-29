@extends('backend.layouts.user_master')
@section('title', 'Main page')
@section('content')

    <div class="app-page-title">
        <div class=page-title-wrapper">
            <div class="category_container">
                @foreach($categoryList as $categoryId => $categoryTitle)
                    <div class="category_small_box" categoryTitle="{{$categoryTitle}}">
                        <h5>{{ $categoryTitle }}</h5>
                        <h5>{{ $categoryUsages[$categoryId] }} usages</h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


        <div class="col-md-12 col-sm-12">
        @foreach($posts as $post)
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="post_small_box" postId="{{$post->id}}">
                        <div class="post_small_box_title">
                            <h2>{{$post->title}}</h2>
                        </div>
                        <div class="post_small_box_author">
                            <h2>{{$post->user->name}}</h2>
                        </div>
                        <div class="post_small_box_category">
                            <h2>{{$post->category->title}}</h2>
                        </div>
                        <div class="text_in_right_down_corner">
                            {{ date('d.m.y', strtotime($post->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            <div class="text-center">
                @if($currentPage == 0)
                @else
                <a href="{{ URL :: to('/main/' . ($currentPage - 1)) }}">
                    <button type="button" class="btn btn-dark rounded-circle btn-lg">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                @endif
                <a href="{{ URL :: to('/main/' . ($currentPage + 1)) }}">
                    <button type="button" class="btn btn-dark rounded-circle btn-lg">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </a>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(".category_small_box").on("click", function() {
            var categoryTitle = $(this).attr("categoryTitle");
            var url = "{{ URL::to('/main/') }}" + '/' + categoryTitle + '/' + "0";
            window.location.href = url;
        });

        $(".post_small_box").on("click", function (){
            var postId = $(this).attr("postId");
            var url = "{{ URL::to('/post/') }}" + '/' + postId;
            window.location.href = url;
        });
    </script>
@stop
