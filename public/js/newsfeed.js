$('input[name=txt_search]').on('keypress',function(event) {
    if(event.which == KEYPRESS_ENTER) {
        let search_query = $(this).val();
        window.location.href = '/home?search_query='+ search_query;
    }
});
