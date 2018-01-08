<!DOCTYPE html>
<html lang="en" ng-app="articlesApp">
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
<body>
	<div class="container" ng-controller="articlesController">
		<div class="row"><br>
			<!-- image loading -->
			<div id="img-loading" ng-hide="loading"></div>
			<!-- end image loading -->
			<input type="hidden" ng-model="pageCurrent">
			<div class="col-xs-12" dir-paginate="a in articles | itemsPerPage: articlesPerPage" total-items="totalArticles" current-page="pagination.current" ng-show="loading">
				<div class="panel panel-default">
					<div class="panel-heading">
						<!-- label -->
						<div ng-switch on="a.platform">
						    <div id="economie" ng-switch-when="economie">
						        <span class="label label-info font-14px">Economie Circulaire</span>
								<em class="pull-right">{{ a.pub_date }}</em>
						        <span class="badge pull-right mar-rig-6px">{{ a.first_name }} {{ a.last_name }}</span>
						    </div>
						    <div id="eclaira" ng-switch-when="eclaira">
						        <span class="label label-warning font-14px">Eclaira</span>
						       	<em class="pull-right">{{ a.pub_date }}</em>
						        <span class="badge pull-right mar-rig-6px">{{ a.first_name }} {{ a.last_name }}</span>
						    </div>
						    <div id="genie" ng-switch-when="genie">
						        <span class="label label-primary font-14px">Genie</span>
						        <em class="pull-right">{{ a.pub_date }}</em>
						        <span class="badge pull-right mar-rig-6px">{{ a.first_name }} {{ a.last_name }}</span>
						    </div>
						</div>
						<!-- end label -->
					</div>
					<div class="panel-body">{{ a.title }}
						<!-- button -->
						<a href="/frontend/articles/edit?id={{ a.id }}&platform={{ a.platform }}#{{ pageCurrent }}"><button class="btn btn-primary pull-right" ng-disabled="!check_user(a.user_platform, a.platform)">Edit link</button></a>
						<button ng-disabled="!check_user(a.user_platform, a.platform)" ng-click="edit_article(a.id, a.platform)" data-target=".edit-article" type="button" class="btn btn-primary pull-right mar-rig-6px" data-toggle="modal">Edit modal</button>
						<button data-target=".preview-article-{{ a.id }}-{{ a.platform }}" type="button" class="btn btn-success pull-right mar-rig-6px" data-toggle="modal">Preview</button>
						<!-- end button -->
					</div>
				</div>
				
				<!-- modal preview -->
				<div class="modal fade preview-article-{{ a.id }}-{{ a.platform }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  	<div class="modal-dialog modal-lg">
				    	<div class="modal-content">
				    		<div class="row">
				    			<div class="col-xs-10 col-xs-offset-1">
				    				<div class="modal-header">
								    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h3 class="modal-title">{{ a.title }}</h3>
								        <em class="pull-right">{{ a.first_name }} {{ a.last_name }}</em>
								    </div>
								    <div ng-bind-html="a.body" class="modal-body font-14px"></div>
								    <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								    </div>
				    			</div>
				    		</div>
				    	</div>
				  	</div>
				</div>
				<!-- end modal preview -->
			</div>
			<!-- pagination -->
			<div class="text-center">
				<dir-pagination-controls boundary-links="true" template-url="/app/lib/angular-utils-pagination/dirPagination.tpl.html" on-page-change="pageChanged(newPageNumber, articlesPerPage)"></dir-pagination-controls>
			</div>
			<!-- end pagination -->
		</div>
		<!-- modal edit -->
		<div class="modal fade edit-article" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  	<div class="modal-dialog modal-lg">
		    	<div class="modal-content">
		    		<div class="row">
		    			<div class="col-xs-10 col-xs-offset-1" ng-repeat="b in article">
		    				<div class="modal-header">
						    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h3 class="modal-title">{{ form_title }}</h3>
						    </div>
						    <div class="modal-body font-14px">
						    	<form name="editForm" class="form-horizontal" novalidate="">
						    		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
						    		<input name="_method" type="hidden" value="PUT">
									<div class="form-group">
										<label for="title" class="col-xs-1 control-label">Title</label>
										<div class="col-xs-11">
											<input ng-model="$parent.title" name="title" type="text" class="form-control" placeholder="Title">
										</div>
									</div>
									<div class="form-group">
										<label for="body" class="col-xs-1 control-label">Body</label>
										<div class="col-xs-11">
											<textarea ui-tinymce="tinymceOptions" ng-model="$parent.body" name="body" class="form-control" placeholder="Body"></textarea>
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
						    <div class="modal-footer">
						    	<button type="submit" ng-click="update_article(b.id, b.platform)" class="btn btn-primary">Update</button>
						        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						    </div>
		    			</div>
		    		</div>
		    	</div>
		  	</div>
		</div>
		<!-- end modal edit -->
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