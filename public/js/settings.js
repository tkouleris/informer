$('[name=setting_country_select]').change(function(){
    var id = $(this).children(":selected").attr("id");
    alert("selected id " + id);
});
