$( document ).ready(function() {
    get_selected_categories_for_country(51);
});

$('[name=setting_country_select]').change(function(){
    var country_id = $(this).children(":selected").attr("id");
    get_selected_categories_for_country(country_id);
});

$('input:checkbox').change(function(){
    let country_id = $('[name=setting_country_select]').find(":selected").attr('id');
    let category_id = $(this).attr('id');
    set_selected_categories_for_country(country_id,category_id);
});




function set_selected_categories_for_country(country_id, category_id) {
    $.ajaxSetup({
        headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    jQuery.ajax({
        url: "/settings/categories/set",
        method: 'post',
        data:{
            'country_id':country_id,
            'category_id':category_id,
        },
        success: function(result)
        {
            result.forEach(function(category){
                let el_category_checkbox = $('[name=chbx_category_'+category['setting_categoryid']+']');
                el_category_checkbox.prop('checked', false);
                if(category['setting_active'] == 1)
                {
                    el_category_checkbox.prop('checked', true);
                }
            });
        },
        error: function (result)
        {
            console.log('error');
            console.log(result)
        }
    });
}


function get_selected_categories_for_country(country_id) {
    jQuery.ajax({
        url: "/settings/categories/"+country_id,
        method: 'get',
        success: function(result)
        {
            result.forEach(function(category){
                let el_category_checkbox = $('[name=chbx_category_'+category['setting_categoryid']+']');
                el_category_checkbox.prop('checked', false);
                if(category['setting_active'] == 1)
                {
                    el_category_checkbox.prop('checked', true);
                }
            });
        },
        error: function (result)
        {
            console.log('error');
            console.log(result)
        }
    });
}
