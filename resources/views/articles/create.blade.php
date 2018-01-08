@extends('layouts.master')

@section('title')
	New article
@stop

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/formValidation.css">
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<h1>New article</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				@if(count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Attention!</strong> There were some problems with your input.
						<br>
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				
				{!! Form::open(array('route' => 'article.save', 'id' => 'defaultForm', 'class' => 'form-horizontal')) !!}
		    		@include('articles/_form', array('button_name' => 'Add'))
				{!! Form::close() !!}
			</div>
		</div>
		
	</div>
@stop

@section('js')
	<script type="text/javascript" src="/js/formvalidation/bootstrap.js"></script>
	<script type="text/javascript" src="/js/formvalidation/formValidation.js"></script>
	<script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
@stop