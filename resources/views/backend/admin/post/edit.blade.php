@extends('backend.layouts.master')
@section('title', ' Edit Post ')
@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>New post information</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {{ Form::open(['route' => 'admin.editPost'])}}
                        {{ Form::hidden('id', $post->id) }}
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="">Title</label>
                        {{ Form::text('title', $post->title , ['class' => 'form-control valid']) }}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for=""> Description </label>
                        {{ Form::text('description', $post->description , ['class' => 'form-control', 'style' => 'height: 120px']) }}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3">
                        <label for=""> Status </label><br/>
                            {{ Form::radio('status', '1',  $post->status == '1', ['class' => 'flat-green']) }}
                            Active
                            {{ Form::radio('status', '0',  $post->status == '0', ['class' => 'flat-green']) }}
                            Inactive
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3">
                        <label for=""> Category </label><br/>
                        {!! Form::select('category', $categoryList, $post->category->id, ['class' => 'flat-green form-control']) !!}
                    </div>
                    <div class="clearfix"></div>
                    {{Form::submit('Update post', ['class'=>'btn btn-success button-submit'])}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
