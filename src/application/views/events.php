<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>BETTY</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Swanky+and+Moo+Moo' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
<body>
	<!-- Begin ported navbar -->
	<div class="navbar navbar-static-top navbar-default">
	  <div class="container">
	    <div class="container">
		<ul class="nav navbar-nav">
	  <li class="active"><div class="navbar-header"><a class="navbar-brand" href="index.html">BETty</a></div>
	    
	  </li>
	</ul>
	
	<?php
	if (!$checked) { 
	  ?>
		<form class="navbar-form navbar-left" role="search" method="post" action="/index.php/auth/login">
		  <div class="form-group">
		    <input name="identity" class="form-control" placeholder="Email Address" type="text">
		    <input name="password" class="form-control" placeholder="Password" type="password">
		    <button type="submit" class="btn btn-default">Login</button>
		    <input type="checkbox"> <font size="1"><b>Remember My Login</b></font></div></form>
	<?php
	}
	else{
	  ?>
		<form class="navbar-form navbar-left" role="search">
	  	<div class="form-group">
	    <button class="btn btn-default"><a href="/index.php/auth/logout">Logout</a></button>
	  </div>
	  </form>
	<?php
	}
	?>
    </div>
  	</div>
	</div> 
	<!-- End ported navbar -->

	<div class="container">
		<button type="button" id="new-event" class="btn">+</button>
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="event-form" action="/index.php/api/events" method="post" style="display:none">
					<label>Name<input type="text" class="form-control" name="name"></label>
					<label>Description<input type="text" class="form-control" name="description"></label>
					<label>Image URL<input type="text" class="form-control" name="image_url"></label>
					<button type="submit" class="btn">Create Event</button>
				</form>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="main">
	</div>

	<!-- Scripts and templates -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.3.0/handlebars.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.marionette/1.5.1-bundled/backbone.marionette.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script id="event-template" type="text/x-handlebars-template">
		<div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
				{{#if image_url}}
					<img data-src="holder.js/100%x180" src="//{{image_url}}">
				{{else}}
					<img data-src="holder.js/100%x180" src="//b.thumbs.redditmedia.com/J5j8e83XNptSZHyU.jpg">
				{{/if}}
				<div class="caption">
					<h3>{{name}}</h3>
					<p>{{description}}</p>
				</div>
			</a>
		</div>
	</script>
	<script>
		var app = app || {};
		app.eventTemplate = Handlebars.compile($('#event-template').html());

  Backbone.sync = function(method, model, options) {
  	var methodMap = {
  	  'create': 'POST',
  	  'update': 'PUT',
  	  'patch':  'PATCH',
  	  'delete': 'DELETE',
  	  'read':   'GET'
  	};
    var type = methodMap[method];

    // Default options, unless specified.
    _.defaults(options || (options = {}), {
      emulateHTTP: Backbone.emulateHTTP,
      emulateJSON: Backbone.emulateJSON
    });

    // Default JSON-request options.
    var params = {type: type, dataType: 'json'};

    // Ensure that we have a URL.
    if (!options.url) {
      params.url = _.result(model, 'url') || urlError();
    }

    // Ensure that we have the appropriate request data.
	if (!options.data && model && (method == 'create' || method == 'update')) {
	      params.contentType = 'application/x-www-form-urlencoded';
	      params.data = $.param(model.toJSON());
	}

    // For older servers, emulate JSON by encoding the request into an HTML-form.
    if (options.emulateJSON) {
      params.contentType = 'application/x-www-form-urlencoded';
      params.data = params.data ? {model: params.data} : {};
    }

    // For older servers, emulate HTTP by mimicking the HTTP method with `_method`
    // And an `X-HTTP-Method-Override` header.
    if (options.emulateHTTP && (type === 'PUT' || type === 'DELETE' || type === 'PATCH')) {
      params.type = 'POST';
      if (options.emulateJSON) params.data._method = type;
      var beforeSend = options.beforeSend;
      options.beforeSend = function(xhr) {
        xhr.setRequestHeader('X-HTTP-Method-Override', type);
        if (beforeSend) return beforeSend.apply(this, arguments);
      };
    }

    // Don't process data on a non-GET request.
    if (params.type !== 'GET' && !options.emulateJSON) {
      params.processData = false;
    }

    // If we're sending a `PATCH` request, and we're in an old Internet Explorer
    // that still has ActiveX enabled by default, override jQuery to use that
    // for XHR instead. Remove this line when jQuery supports `PATCH` on IE8.
    if (params.type === 'PATCH' && noXhrPatch) {
      params.xhr = function() {
        return new ActiveXObject("Microsoft.XMLHTTP");
      };
    }

    // Make the request, allowing the user to override any Ajax options.
    var xhr = options.xhr = Backbone.ajax(_.extend(params, options));
    model.trigger('request', model, xhr, options);
    return xhr;
  };

		app.Event = Backbone.Model.extend({
			defaults: {
				image_url: 'b.thumbs.redditmedia.com/J5j8e83XNptSZHyU.jpg'
			}
		});
		app.EventList = Backbone.Collection.extend({
			model: app.Event,
			url: '/index.php/api/events'
		});
		app.EventView = Backbone.Marionette.ItemView.extend({
			tagName: 'div',
			className: 'row',
			template: app.eventTemplate,
			events: {
				'click': 'changeUrl'
			},
			changeUrl: function() {
				Backbone.history.navigate(this.model.get('event_id'), 
					{ trigger: true });
			}
		});
		app.EventListView = Backbone.Marionette.CollectionView.extend({
			initialize: function() {
				this.collection = new app.EventList();
				this.collection.fetch({reset: true});
			},
			el: '#main',
			itemView: app.EventView,
			tagName: 'div',
		});
		app.Router = Backbone.Router.extend({
			routes: {
				':event_id': function(event_id) {
					console.log('event_id is ' + event_id);
				},
				':event_id/outcomes': function() {
					console.log('trying to get outcomes');
				}
			}
		});
		var router = new app.Router;
		Backbone.history.start();

		var eventListView = (new app.EventListView()).render();
		$('#new-event').click(function() {
			$('#event-form').toggle();
		});
		$('#event-form').submit(function(event) {
			event.preventDefault();
			var array = $('#event-form').serializeArray();
			var obj = _.object(_.map(array, _.values));
			eventListView.collection.create(obj);
		});
	</script>
</body>
</html>
