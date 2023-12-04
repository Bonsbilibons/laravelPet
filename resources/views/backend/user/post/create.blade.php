@extends('backend.layouts.user_master')
@section('title', ' New Post ')
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
                    {{ Form::open(['route' => 'user.createPost','files' => true])}}
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="">Title</label>
                        {{ Form::text('title', 'Title', ['class' => 'form-control valid']) }}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for=""> Description </label>
                        {{ Form::text('description', 'Description', ['class' => 'form-control', 'style' => 'height: 120px']) }}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3">
                        <label for=""> Status </label><br/>
                        {{ Form::radio('status', '1', ['class' => 'flat-green form-control']) }}
                        Active
                        {{ Form::radio('status', '0', ['class' => 'flat-green form-control']) }}
                        Inactive
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3">
                        <label for=""> Category </label><br/>
                        {!! Form::select('category', $categoryList, null, ['class' => 'flat-green form-control']) !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3">
                        <label for=""> Category </label><br/>
                        {!! Form::file('image[]', ['class' => 'flat-green form-control', 'multiple' => true]) !!}
                    </div>
                    <div class="clearfix"></div>
                    {{Form::submit('Create post', ['class'=>'btn btn-success button-submit'])}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop
