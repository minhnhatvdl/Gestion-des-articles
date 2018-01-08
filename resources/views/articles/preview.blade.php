@extends('layouts.master')

@section('title')
	@foreach($article as $a)
		{{ $a->title }}
	@endforeach
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<a href="{{ route('articles') }}" class="btn btn-link">
					<span class="glyphicon glyphicon-chevron-left"></span>
					Back to articles list
				</a>
			</div>
		</div>
		@foreach($article as $a)
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
					<h2>{{ $a->title }}</h2>
					<em class="pull-right">{{ $a->first_name }} {{ $a->last_name }}</em><br>
					<p class="pull-right">{{ $a->pub_date }}</p><br><hr>
					<p class="font-14px">{!! $a->body !!}</p>
				</div>
			</div>
		@endforeach
	</div>
@stop