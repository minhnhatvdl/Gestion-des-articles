<div class="form-group">
	{!! Form::label('title', 'Title', array('class' => 'col-xs-2 control-label')) !!}
	<div class="col-xs-10">
		{!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title')) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('body', 'Body', array('class' => 'col-xs-2 control-label')) !!}
	<div class="col-xs-10">
		{!! Form::textarea('body', null, array('id' => 'tinymce1', 'class' => 'form-control', 'placeholder' => 'Body')) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('state', 'State', array('class' => 'col-xs-2 control-label pad-top-0px')) !!}
	<div class="col-xs-10">
		{!! Form::checkbox('state', 1) !!}
	</div>
</div>
<div class="form-group">
	<div class="col-xs-10 col-xs-offset-2">
		{!! Form::submit($button_name, array('class' => 'btn btn-primary')) !!}
	</div>
</div>