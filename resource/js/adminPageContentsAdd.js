$(document).ready(function() {
    $('#simplesample_return').click(function() {
        adminPageContentsAdd.returnList();
    });
    $('#simplesample_submit').click(function() {
        adminPageContentsAdd.submit();
    });    
});

var adminPageContentsAdd = {
        mostAction : function() {
            location.href = usbuilder.getUrl('adminPageContentsAdd');
        },        
        returnList : function() {
            location.href = usbuilder.getUrl('adminPageContentsList');
        },
        submit : function() {
            var result = oValidator.formName.getMessage('simplesample_add'); 
            
            if (result == true){
                $('form[name="simplesample_add"]').submit();
            }
        }
};