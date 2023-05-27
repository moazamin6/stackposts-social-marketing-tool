<script type="text/javascript">
var tokenClient;
var accessToken = null;
var pickerInited = false;
var gisInited = false;
var SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly';
var GOOGLE_CLIENT_ID = '<?php _ec( get_option("fm_google_client_id", "") )?>';
var GOOGLE_API_KEY = '<?php _ec( get_option("fm_google_api_key", "") )?>';

function handleAuthClick() {
    tokenClient.callback = async (response) => {
      	if (response.error !== undefined) {
        	throw (response);
      	}
		accessToken = response.access_token;
		await createPicker();
    };

    if (accessToken === null) {
      	tokenClient.requestAccessToken({prompt: 'consent'});
    } else {
      	tokenClient.requestAccessToken({prompt: ''});
    }
}

function gapiLoaded() {
	gapi.load('client:picker', initializePicker);
}


async function initializePicker() {
	await gapi.client.load('https://www.googleapis.com/discovery/v1/apis/drive/v3/rest');
	pickerInited = true;
}


function gisLoaded() {
	tokenClient = google.accounts.oauth2.initTokenClient({
		apiKey: GOOGLE_API_KEY,
		client_id: GOOGLE_CLIENT_ID,
		scope: SCOPES,
		callback: '',
	});
	gisInited = true;
}

function createPicker() {
    const view = new google.picker.View(google.picker.ViewId.DOCS);
    const picker = new google.picker.PickerBuilder()
        .enableFeature(google.picker.Feature.NAV_HIDDEN)
        .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
        .setDeveloperKey(GOOGLE_API_KEY)
        .setOAuthToken(accessToken)
        .addView(view)
        .addView(new google.picker.DocsUploadView())
        .setCallback(pickerCallback)
        .build();
    picker.setVisible(true);
}


function pickerCallback(data) {
	if (data.action == google.picker.Action.PICKED) {
	  	var fileId = data.docs[0].id;
	  	gapi.client.drive.files.get({
	    	fileId: fileId,
	    	fields: '*'
	  	}).then(function(response) {
	  		console.log(response);
	    	console.log('File name:', response.result.name);
	    	console.log('File URL:', response.result.webContentLink);
	    	File_manager.saveFile(response.result.webContentLink);
	  	});
	}
}
</script>

<script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
<script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>