@extends('backend.layouts.user_master')
@section('title', 'Main page')
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="post_big_box">
                        <div class="post_big_box_title">
                            <h2>{{$post->title}}</h2>
                        </div>
                        <div class="post_big_box_description">
                            <h2>{{$post->description}}</h2>
                        </div>
                        @foreach($post->images as $image)
                            <div class="post_image_box" id="{{$image->id}}">
                                <img src="{{asset('assets/images/postsImages/'. $post->id . '/' . $image->title)}}" class="images_for_post"/>
                            </div>
                        @endforeach
                        <div class="post_big_box_author">
                            <h2>{{$post->user->name}}</h2>
                        </div>
                        <button class="like_button" type="button">Like</button>
                        <div class="likes_of_post">
                            <h2 id="likes_of_post">{{$post->likes->count()}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="create_comment_box">
                            {{ Form::open(['route' => 'post.leaveComment', 'method' => 'POST']) }}
                                {{ Form::hidden('post_id', $post->id) }}
                                {{ Form::text('comment', 'Leave here your opinion', ['class'=> 'form-control', 'style' => 'height: 120px']) }}
                                <br>
                                {{ Form::submit('Leave comment', ['class'=>'btn btn-success button-submit'])}}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    @foreach($post->comments->sortByDesc('created_at') as $comment)
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="comment_box">
                            <div class="comment_box_author">
                                <h2>{{$comment->user->name}}</h2>
                            </div>
                            <div class="comment_box_text">
                                <h2>{{ $comment->comment  }}</h2>
                            </div>
                            <div class="text_in_right_down_corner">
                                {{ date('d.m.y', strtotime($comment->created_at)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{ Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            var likeButton = $('.like_button');
            $.ajax({
                url: '/post/is-post-liked',
                type: 'POST',
                data: {
                    userId: '{{ Auth::user()->id }}',
                    postId: '{{$post->id}}',
                },
                headers: {
                    "X-CSRF-TOKEN": CSRF_TOKEN,
                    "Authorization": "Bearer {{ Cookie::get('access_token') }}",
                },
                "dataType": 'json',
                success: function(response) {
                    if(response === 1)
                    {
                        likeButton.text('Liked');
                        likeButton.toggleClass('liked');
                    }
                    else{
                    }
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });


        $('.like_button').on("click", function ()
        {
            var likeButton = $('.like_button');
            if($(this).hasClass('liked'))
            {
                $.ajax({
                    url: '/post/dislike-post',
                    type: 'POST',
                    data: {
                        postId: '{{$post->id}}',
                    },
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Authorization": "Bearer {{ Cookie::get('access_token') }}",
                    },
                    "dataType": 'json',
                    success: function(response) {
                        likeButton.text('Like');
                        likeButton.toggleClass('liked');

                        var likesCount = parseInt($('#likes_of_post').text());
                        $('#likes_of_post').text(likesCount - 1);

                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
            else {
                $.ajax({
                    url: '/post/like-post',
                    type: 'POST',
                    data: {
                        postId: '{{$post->id}}',
                    },
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Authorization": "Bearer {{ Cookie::get('access_token') }}",
                    },
                    "dataType": 'json',
                    success: function(response) {
                        likeButton.text('Liked');
                        likeButton.toggleClass('liked');

                        var likesCount = parseInt($('#likes_of_post').text());
                        $('#likes_of_post').text(likesCount + 1);

                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>
@stop
