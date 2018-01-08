@extends('layouts.master')

@section('title')
	@foreach($article as $a)
		{{ $a->title }}
	@endforeach
@stop

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/formValidation.css">
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<h1>Edit an article</h1>
				<hr>
			</div>
		</div>
		@foreach($article as $a)
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
					{!! Form::model($a, array('route' => array('article.update', $a->id, $a->platform) , 'method' => 'put', 'class' => 'form-horizontal')) !!}
    					@include('articles/_form', array('button_name' => 'Save'))
					{!! Form::close() !!}
				</div>
			</div>
		@endforeach
	</div>
@stop

@section('js')
	<script type="text/javascript" src="/js/formvalidation/bootstrap.js"></script>
	<script type="text/javascript" src="/js/formvalidation/formValidation.js"></script>
	<script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
@stop