$('[name=setting_country_select]').change(function(){
    var country_id = $(this).children(":selected").attr("id");
    get_selected_categories_for_country(country_id);
});


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
