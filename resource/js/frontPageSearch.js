/**
 * 
sdk_Module('simplesample>search').ready(function($M) {
    sSearchKeyword = $M.data('sSearchKeyword');
    sResultUrl = $M.data('sResultUrl');
    $M(".class_search_keyword").val(sSearchKeyword);
    $M(".class_search_button").click(function() {
        alert($M(".class_search_keyword").val() + '//' + sSearchKeyword + '//' + sResultUrl);
        //location.href = "'.$sResultUrl.'" + $M(".class_search_keyword").val();
    });
});
 */
