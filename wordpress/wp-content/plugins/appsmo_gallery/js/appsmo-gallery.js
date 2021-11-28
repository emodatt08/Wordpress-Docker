var $=jQuery.noConflict();

$(document).ready(function(){
    hideRetrievalMethods();
    toggleOverwritePhotos();
    $('select').on('change', function() {
        toggleQuery(this.value);
      });
   
});


function toggleQuery(query){
    $('#appsmo-gallery-search-criteria').hide();
        $('#appsmo-gallery-category').hide();
    if(query ==="search_by_query"){
        $('#appsmo-gallery-search-criteria').show();
        $('#appsmo-gallery-category').hide();      
    }
    if(query ==="search_by_category"){
        $('#appsmo-gallery-search-criteria').hide();
        $('#appsmo-gallery-category').show();
    }
}

function hideRetrievalMethods(){
    $('#appsmo-gallery-search-criteria').hide();
    $('#appsmo-gallery-category').hide();
}

function toggleOverwritePhotos(){
    if ($('.appsmo-gallery-store-photo').is(':checked')) {
        $('#appsmo-gallery-overwrite-photo').show();
    }else{
        $('#appsmo-gallery-overwrite-photo').hide();
    }
    
}


