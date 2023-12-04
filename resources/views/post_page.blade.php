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

@stop
