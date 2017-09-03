<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://apis.google.com/js/platform.js"></script>
		
	</head>
	<body>
				<div class="container" style="margin-top:10%;">
					<div class="row">
						<div class="col-md-6 well col-md-offset-3">
							
								<fieldset>
									<div class="alert alert-info">
									  <strong>Info !</strong> Pour inscrire au jeux de concours vous devrez se connecter a votre compte youtube est s'abonner a notre chaine Youtube.
									</div>
									<div class="alert alert-warning" style="display:none;">
									  <strong>Attention !</strong>  Abonnez vous sur notre chaine Youtube.
									</div>
									<div class="form-group">

										<div class="col-md-12">
											<input type="button" class="btn btn-info pull-right" value="S'inscrire" id="subscribe" disabled>
											<div class="g-ytsubscribe" data-channelid="UCLdVmxwj9dQqM8tJJp2LYGw" data-layout="full" data-count="default" ></div>
											<button class="btn btn-link" id="execute-request-button" style="display:none;">Se Connecter</button>
										</div>
									</div>
									<input type="hidden" name="action" value="save"/>
								</fieldset>
								
							
						</div>
					</div>
				</div>
	
	</body>
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script async defer src="https://apis.google.com/js/api.js" 
        onload="this.onload=function(){};handleClientLoad()" 
        onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>
<script>

  /***** START BOILERPLATE CODE: Load client library, authorize user. *****/

  // Global variables for GoogleAuth object, auth status.
  var GoogleAuth;

  /**
   * Load the API's client and auth2 modules.
   * Call the initClient function after the modules load.
   */
  function handleClientLoad() {
    gapi.load('client:auth2', initClient);
  }

  function initClient() {
    // Initialize the gapi.client object, which app uses to make API requests.
    // Get API key and client ID from API Console.
    // 'scope' field specifies space-delimited list of access scopes

    gapi.client.init({
        'clientId': '861893956846-rhfmr9u68bappqtf0legf0pmounbiicj.apps.googleusercontent.com',
        'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest'],
        'scope': 'https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner'
    }).then(function () {
      GoogleAuth = gapi.auth2.getAuthInstance();

      // Listen for sign-in state changes.
      GoogleAuth.isSignedIn.listen(updateSigninStatus);

      // Handle initial sign-in state. (Determine if user is already signed in.)
      setSigninStatus();

      // Call handleAuthClick function when user clicks on "Authorize" button.
      $('#execute-request-button').click(function() {
        handleAuthClick(event);
      }); 
    });
  }

  function handleAuthClick(event) {
    // Sign user in after click on auth button.
    GoogleAuth.signIn();
  }

  function setSigninStatus() {
    var user = GoogleAuth.currentUser.get();
    isAuthorized = user.hasGrantedScopes('https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner');
    // Toggle button text and displayed statement based on current auth status.
    if (isAuthorized) {
      defineRequest();
	    $('#execute-request-button').hide();
		$('#subscribe').attr('disabled','false');
    }else{
		$('#execute-request-button').show();
		$('#subscribe').attr('disabled','true');
		$('#yt-subscribe').hide();
		}
  }

  function updateSigninStatus(isSignedIn) {
    setSigninStatus();
  }

  function createResource(properties) {
    var resource = {};
    var normalizedProps = properties;
    for (var p in properties) {
      var value = properties[p];
      if (p && p.substr(-2, 2) == '[]') {
        var adjustedName = p.replace('[]', '');
        if (value) {
          normalizedProps[adjustedName] = value.split(',');
        }
        delete normalizedProps[p];
      }
    }
    for (var p in normalizedProps) {
      // Leave properties that don't have values out of inserted resource.
      if (normalizedProps.hasOwnProperty(p) && normalizedProps[p]) {
        var propArray = p.split('.');
        var ref = resource;
        for (var pa = 0; pa < propArray.length; pa++) {
          var key = propArray[pa];
          if (pa == propArray.length - 1) {
            ref[key] = normalizedProps[p];
          } else {
            ref = ref[key] = ref[key] || {};
          }
        }
      };
    }
    return resource;
  }

  function removeEmptyParams(params) {
    for (var p in params) {
      if (!params[p] || params[p] == 'undefined') {
        delete params[p];
      }
    }
    return params;
  }

  function executeRequest(request) {
    request.execute(function(response) {
      console.log(response.items);
	  if(response.items.length >0){
		  
		  $('#yt-subscribe').hide();
		  $('#subscribe').removeAttr('disabled');
		}else{
			
		  $('#subscribe').attr('disabled','true');
		  $('.alert-warning').show();
		  $('#yt-subscribe').show();
		}
    });
  }

  function buildApiRequest(requestMethod, path, params, properties) {
    params = removeEmptyParams(params);
    var request;
    if (properties) {
      var resource = createResource(properties);
      request = gapi.client.request({
          'body': resource,
          'method': requestMethod,
          'path': path,
          'params': params
      });
    } else {
      request = gapi.client.request({
          'method': requestMethod,
          'path': path,
          'params': params
      });
    }
    executeRequest(request);
  }

  /***** END BOILERPLATE CODE *****/

  
  function defineRequest() {
    // See full sample for buildApiRequest() code, which is not 
// specific to a particular youtube or youtube method.

buildApiRequest('GET',
                '/youtube/v3/subscriptions',
                {'forChannelId': 'UCLdVmxwj9dQqM8tJJp2LYGw',
                 'mine': 'true',
                 'part': 'snippet,contentDetails'});

  }
  $('#subscribe').click(function(){
	   window.location = "http://hichourlocal.fr/subscrib.php";
	  
  });

 
</script>
</html>