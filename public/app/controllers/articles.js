app.constant('API_URL_ARTICLES', 'http://localhost:8000/v1/articlesapi');
app.constant('FRONT_URL_ARTICLES', 'http://localhost:8000/frontend/articles');
app.constant('ARTICLES_PER_PAGE', 5);

app.config(function($locationProvider) {
    $locationProvider.html5Mode({
	  enabled: true,
	  requireBase: false
	});
});

app.controller('articlesController', function($scope, $http, API_URL_ARTICLES, ARTICLES_PER_PAGE, FRONT_URL_ARTICLES) {
	/* page current */
	var page_current = window.location.hash.substr(1);
	if(page_current == ''){
		page_current = 1;
	}
	/* loading */
	$scope.loading = false;
	/* button check */
	$scope.check_user = function(userPlatform, platform) {
		return (userPlatform.search(platform) >= 0)? true:false;
	}
	/* edit article */
	$scope.edit_article = function(id, platform) {
		$scope.form_title = 'Edit the article';
		
		$http({
		  	method: 'GET',
		  	url: API_URL_ARTICLES + '/' + id + '/' + platform
		}).then(function successCallback(response) {
				console.log(response);
		    	$scope.article = response.data.records;
		    	var records = response.data.records;
		    	for(x in records){
		    		$scope.title = records[x].title;
		    		$scope.body = records[x].body;
		    	}
		  	}, function errorCallback(response) {
		    	alert("error");
		  	});
	};
	/* update article */
	$scope.update_article = function(id, platform) {
		var state = document.getElementById("state").checked;
		(state)? state = 1 : state = 0;
		var data = $.param({
			title: $scope.title,
			body: $scope.body,
			state: state
		});
		$http({
		  	method: 'PUT',
		  	url: API_URL_ARTICLES + '/' + id + '/' + platform + '?' + data,
		  	data: data
		})
			.then(function successCallback(response) {
				console.log(response);
				var modified = response.data;
				if(modified == 1){
					swal("Good job!", "You edited the article", "success");
					location.reload();
				} else if(modified == 0){
					swal("No!", "Nothing to change", "error");
				}
		  	}, function errorCallback(response) {
		    	alert("error");
		  	});
	};
	/* pagination */
    $scope.totalArticles = 0;
    $scope.articlesPerPage = ARTICLES_PER_PAGE;
    getResultsPage(page_current, $scope.articlesPerPage);
    $scope.pagination = { current: page_current };
    $scope.pageChanged = function(newPage, articlesPerPage) {
        getResultsPage(newPage, articlesPerPage);
    };
    function getResultsPage(pageNumber, articlesPerPage) {
    	$scope.pageCurrent = pageNumber;
        $http.get(API_URL_ARTICLES + '?page=' + pageNumber)
            .then(function(result) {
            	var articles_in_page = result.data.records.slice(articlesPerPage*(pageNumber -1), articlesPerPage*pageNumber);
            	console.log(articles_in_page);
                $scope.articles = articles_in_page;
                $scope.totalArticles = result.data.records.length;
                $scope.loading = true;
            });
        window.location.href = FRONT_URL_ARTICLES + '#' + pageNumber;
    }
	/* tinymce */
	$scope.tinymceOptions = {
	    inline: false,
	    relative_urls: false,
		remove_script_host: false,
	    plugins : 'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor responsivefilemanager',
	    toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
	   	toolbar2: "link image responsivefilemanager | print preview code media fullpage | forecolor backcolor emoticons",
	   	image_advtab: true,
	   	external_filemanager_path: "/filemanager/",
	   	filemanager_title: "Responsive Filemanager" ,
	   	external_plugins: {"filemanager" : "/filemanager/plugin.min.js"},
	    skin: 'lightgray',
	    theme : 'modern'
	};
});

app.controller('editController', function($scope, $http, $location, API_URL_ARTICLES, FRONT_URL_ARTICLES) {
	var search = $location.search();
	$http({
	  	method: 'GET',
	  	url: API_URL_ARTICLES + '/' + search.id + '/' + search.platform
	}).then(function successCallback(response) {
			console.log(response);
			$scope.article = response.data.records;
	    	var records = response.data.records;
	    	for(x in records){
	    		$scope.title = records[x].title;
	    		$scope.body = records[x].body;
	    	}
	  	}, function errorCallback(response) {
	    	alert("error");
	  	});

	$scope.back_to_articles = function() {
		/* page current */
		var page_current = window.location.hash.substr(1);
		if(page_current == ''){
			page_current = 1;
		}
		window.location.href = FRONT_URL_ARTICLES + '#' + page_current;
	}
	
	$scope.update_article = function() {
		var state = document.getElementById("state").checked;
		(state)? state = 1 : state = 0;
		var data = $.param({
			title: $scope.title,
			body: $scope.body,
			state: state
		});
		$http({
		  	method: 'PUT',
		  	url: API_URL_ARTICLES + '/' + search.id + '/' + search.platform + '?' + data,
		  	data: data
		})
			.then(function successCallback(response) {
				console.log(response);
				var modified = response.data;
				if(modified == 1){
					swal("Good job!", "You edited the article", "success");
					$scope.back_to_articles();
				} else if(modified == 0){
					swal("No!", "Nothing to change", "error");
				}
		  	}, function errorCallback(response) {
		    	alert("error");
		  	});
	};

	

	$scope.tinymceOptions = {
	    inline: false,
	    relative_urls: false,
		remove_script_host: false,
	    plugins : 'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor responsivefilemanager',
	    toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
	   	toolbar2: "link image responsivefilemanager | print preview code media fullpage | forecolor backcolor emoticons",
	   	image_advtab: true,
	   	external_filemanager_path: "/filemanager/",
	   	filemanager_title: "Responsive Filemanager" ,
	   	external_plugins: {"filemanager" : "/filemanager/plugin.min.js"},
	    skin: 'lightgray',
	    theme : 'modern'
	};
});
