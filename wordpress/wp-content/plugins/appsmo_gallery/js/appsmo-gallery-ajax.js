var $=jQuery.noConflict();

$(document).ready(function(e){

    $('.appsmo-gallery-unsplash-button').on('click', function(e) {
        retrieveImage(e);
    });
    hoverFunctionality();
    $(".appsmo-gallery-image-grid").on("click", ".appsmo_gallery_on_hover", function(e) {
        $('#appsMoGalleryModal').show();
        $('.appsmo-edit-image').attr("src", $(this).attr('src'));
    });

    $('.close').click(function(){
        $('#appsMoGalleryModal').hide();
    }); 
    
    

    $('.appsmo-download-single-image-button').on('click', function(e) {
        downloadImage(e, "");
    });

    
    $('.appsmo-gallery-unsplash-download-all-button').on('click', function(e) {
        var photoDataInCache = getInLocalStorage();
        console.log("photoDataInCache",photoDataInCache);
        if(photoDataInCache  != ""){
            photoDataInCache.forEach(function(photo){
                downloadImage(e, photo.show);
            })
            return;
        }     
    });
});


var retrieveImage = (e) => {
    var data = {
		'action': 'appsmo_gallery_action',
		'service': $("input[name=service]").val()      
	};
    //clearInLocalStorage();
    var download_icon = $('.appsmo-gallery-download-icon-url').val();
    var ifDownloadedAlready = getInLocalStorage();
    console.log(ifDownloadedAlready);
    if(ifDownloadedAlready  != ""){
        ifDownloadedAlready.forEach(function(response){
            $('.appsmo-gallery-image-grid').append(
                '<img class="appsmo_gallery_on_hover" src="'+response.show+'" alt="'+response.description+'">' 
                );
        })
        return;
    }
	jQuery.post(ajax_object.ajax_url, data, function(response) {
		if(response.responseCode === "200"){
            console.log(response.data)
            var photoData =  response.data;
            setInLocalStorage(response.data);
            photoData.forEach(function(response){
                $('.appsmo-gallery-image-grid').append(
                    '<img class="appsmo_gallery_on_hover" src="'+response.show+'" alt="'+response.description+'">' 
                    );
            })
           
        }
	});
}

var downloadImage = (e, imagesrc) => {
    var data = {
		'action': 'appsmo_gallery_action_download',
		'image_url': (imagesrc) ? imagesrc : $(".appsmo-edit-image").attr('src')      
	};
    console.log(data);
  
	jQuery.post(ajax_object.ajax_url, data, function(response) {
        console.log("response: ", response);
		if(response.responseCode === "200"){
            console.log(response.data)
            var photoData =  response.data.url;
            $(".appsmo-edit-image").attr('src', photoData);
            $(".appsmo_gallery_on_hover").attr('src', photoData);
            setImageMessages('Image Downloaded', 'green');
            
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
    var photos = JSON.parse(localStorage.getItem('photos'));
    return photos;
}

var hoverFunctionality = () =>{
    $(".appsmo_gallery_on_hover").on({
        mouseenter: function () {
            console.log("mousenter")
            $('.appsmo-gallery-download-icon').show();
        },
        mouseleave: function () {
            $('.appsmo-gallery-download-icon').hide();
        }
    });
}

var setImageMessages = (message, color) =>{
    var msgElement = $('.appsmo-gallery-messages')
    msgElement.text(message);
    msgElement.css('color',color);
}

