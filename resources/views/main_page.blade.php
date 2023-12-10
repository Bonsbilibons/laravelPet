@extends('backend.layouts.user_master')
@section('title', 'Main page')
@section('content')


    <div class="category_container">
        @foreach($categoryList as $categoryId => $categoryTitle)
            <div class="main-card mb-3 card">
                <div class="category_small_box" categoryTitle="{{$categoryTitle}}">
                    <h5>{{ $categoryTitle }} ({{ $categoryUsages[$categoryId] }})</h5>
                </div>
            </div>
        @endforeach
    </div>

    <div class="top_users_info_container">
        <div class="main-card mb-3 card">
            <div class="top_users_info">
                <h4>TOP USERS BY COUNT OF FOLLOWERS</h4>
                @foreach($topUsersByFollowers as $userPosition => $user)
                    <h5>{{$userPosition + 1}}. {{$user->name}} : {{$user->followers_count}}</h5>
                @endforeach
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="top_users_info">
                <h4>TOP USERS BY COUNT OF POSTS</h4>
            @foreach($topUsersByPosts as $userPosition => $user)
                <h5>{{$userPosition + 1}}. {{$user->name}} : {{$user->posts_count}}</h5>
            @endforeach
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="top_users_info">
                <h4>TOP USERS BY COUNT OF Likes</h4>
                @foreach($topUsersByLikes as $userPosition => $user)
                    <h5>{{$userPosition + 1}}. {{$user->name}} : {{$user->likes_count}}</h5>
                @endforeach
            </div>
        </div>
    </div>


        <div class="post_main_container">
        @foreach($posts as $post)
            <div class="main-card mb-3 card">
                <div class="post_small_box" postId="{{$post->id}}">
                    <div class="post_small_box_title">
                        <h2>{{$post->title}}</h2>
                    </div>
                    <div class="post_small_box_author">
                        <a href="{{ URL :: to('user/public-profile/' . $post->user->id ) }}">
                        <h2>{{$post->user->name}}</h2>
                        </a>
                    </div>
                    <div class="post_small_box_category">
                        <h2>{{$post->category->title}}</h2>
                    </div>
                    <div class="text_in_right_down_corner">
                        {{ date('d.m.y', strtotime($post->created_at)) }}
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
