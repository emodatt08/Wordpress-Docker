var $=jQuery.noConflict();

$(document).ready(function(){
    $('.appsmo-gallery-unsplash-button').on('click', function(e) {
        retrieveImage(e);
      });
   
});

var retrieveImage = (e) => {
    var data = {
		'action': 'appsmo_gallery_action',
		'service': $("input[name=service]").val()      
	};
    clearInLocalStorage();
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		if(response.responseCode === "200"){
            console.log(response.data)
            var photoData =  response.data;
            setInLocalStorage(response.data);
            photoData.forEach(function(response){
                $('.appsmo-gallery-image-grid').append(
                    '<img class="image-grid-col-2 image-grid-row-2" src="'+response.show+'" alt="'+response.description+'">' 
                    );
            })
           
        }
	});
}

var setInLocalStorage = (data) =>{
    localStorage.setItem('photos', JSON.stringify(data));
}


var clearInLocalStorage = () =>{
    localStorage.setItem('photos', "");
}


var getInLocalStorage = (data) =>{
    var photos = localStorage.getItem('photos');
    return photos;
}

