@extends('layouts.master')

@section('title', 'Articles')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
@stop

@section('content')
	<div class="container">
		@foreach($articles as $a)
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 jumbotron">
					<!-- label -->
					@if($a->platform == 'economie')
						<span id="label_platform" class="label label-info">{{ $a->platform }}</span>
					@endif
					@if($a->platform == 'eclaira')
						<span id="label_platform" class="label label-warning">{{ $a->platform }}</span>
					@endif
					@if($a->platform == 'genie')
						<span id="label_platform" class="label label-primary">{{ $a->platform }}</span>
					@endif
					<!-- end label -->
					<!-- pub date -->
					<span id="label_pub_date" class="label label-default">{{ $a->pub_date }}</span>
					<!-- end pub date -->
					<h2>{{ $a->title }}</h2>
					<em class="pull-right">{{ $a->first_name }} {{ $a->last_name }}</em><br><hr>
					<p class="font-14px">{{ text_only($a->body) }}</p>
					<!-- button -->
					<a href="{{ route('article.edit', array('id' => $a->id, 'platform' => $a->platform)) }}" class="btn btn-primary pull-right">Edit</a>
					<button data-target=".preview-article-{{ $a->id }}" type="button" class="btn btn-success pull-right mar-rig-6px" data-toggle="modal">Preview</button>
					<a class="btn btn-link pull-right mar-rig-6px" href="{{ route('article.preview', array('id' => $a->id, 'platform' => $a->platform)) }}">Read more</a>
					<!-- end button -->
				</div>
			</div>
			<div class="modal fade preview-article-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			  	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">
			    		<div class="row">
			    			<div class="col-xs-8 col-xs-offset-2">
			    				<div class="modal-header">
							    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h2 class="modal-title">{{ $a->title }}</h2>
							        <em class="pull-right">{{ $a->first_name }} {{ $a->last_name }}</em>
							    </div>
							    <div class="modal-body">
							        {!! $a->body !!}
							    </div>
							    <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							    </div>
			    			</div>
			    		</div>
			    	</div>
			  	</div>
			</div>
		@endforeach
	</div>
	
@stop

@section('js')
	<script type="text/javascript" src="/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
@stop