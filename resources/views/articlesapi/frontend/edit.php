<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Frontend Articles</title>

	<!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/sweetalert.css">

	<script type="text/javascript" src="/app/lib/angular.min.js"></script>
	<script type="text/javascript" src="/app/lib/angular-sanitize.js"></script>
	<script type="text/javascript" src="/app/lib/angular-utils-pagination/dirPagination.js"></script>
</head>
<body ng-app="articlesApp">
	<div class="container" ng-controller="editController">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<h1>Edit an article</h1>
				<hr>
				<form name="editForm" class="form-horizontal" novalidate="">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		    		<input name="_method" type="hidden" value="PUT">
					<div class="form-group">
						<label for="title" class="col-xs-1 control-label">Title</label>
						<div class="col-xs-11">
							<input ng-model="title" name="title" type="text" class="form-control" placeholder="Title">
						</div>
					</div>
					<div class="form-group">
						<label for="body" class="col-xs-1 control-label">Body</label>
						<div class="col-xs-11">
							<textarea ui-tinymce="tinymceOptions" ng-model="body" name="body" class="form-control" placeholder="Body" cols="50" rows="10"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="state" class="col-xs-1 control-label pad-top-0px">State</label>
						<div class="col-xs-11">
							<input id="state" checked="checked" name="state" type="checkbox">
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-8 col-xs-offset-2" ng-repeat="a in article">
				<button type="button" ng-click="update_article(a.id, a.platform)" class="btn btn-primary pull-right">Update</button>
				<button type="button" ng-click="back_to_articles()" class="btn btn-danger pull-right mar-rig-6px">Back</button>
			</div>
		</div>
	</div>
	<!-- JavaScripts -->
	<script type="text/javascript" src="/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="/app/app.js"></script>
	<script type="text/javascript" src="/app/controllers/articles.js"></script>
	<script type="text/javascript" src="/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/ui-tinymce/bower_components/tinymce-dist/tinymce.js"></script>
	<script type="text/javascript" src="/ui-tinymce/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
	<script type="text/javascript" src="/js/ui-bootstrap.min.js"></script>
</body>
</html>