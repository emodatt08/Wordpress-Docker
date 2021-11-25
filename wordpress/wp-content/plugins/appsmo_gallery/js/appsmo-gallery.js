var $=jQuery.noConflict();

$(document).ready(function(){
    hideRetrievalMethods();
    $('select').on('change', function() {
        toggleQuery(this.value);
      });
   
});


function toggleQuery(query){
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