$(document).ready(function() {
    $('#simplesample_delete_button').click(function() {
        adminPageContentsList.deletePopup();
    });
    $('#simplesample_delete_action').click(function() {
        adminPageContentsList.deleteAction();
    });
    $('.chk_all').click(function() {
        if ($('.chk_all').prop('checked') == true) {
            $("input[name='idx[]']").prop('checked', true);
        } else {
            $("input[name='idx[]']").prop('checked', false);
        }
    });
});

var adminPageContentsList = {
        mostAction : function() {
            location.href = usbuilder.getUrl('adminPageContentsAdd') + '&seq=' + $.url().param("seq");
        },
        deletePopup : function() {
            var total_checked = $("input[name='idx[]']:checked").length;
            
            if(total_checked==0){
                sdk_message.show(LANG['msg_001'], 'warning')
            }else{
                sdk_popup.load('simplesample_delete_popup').skin('admin').layer({
                    'title' : LANG['ttl_001'],
                    'width' : 250
                });
            }
        },
        deleteAction : function() {
            var total_checked = $("input[name='idx[]']:checked").length;
            if (total_checked > 0) {
                var aIdx = [];
                $("input[name='idx[]']:checked").each(function() {
                    aIdx.push($(this).val());
                });
                var options = {
                        url : usbuilder.getUrl('apiContentsDelete'),
                        type : 'post',
                        data : 'idx='+aIdx,
                        dataType : 'json',
                        success : function (responseText) {
                            if (responseText['Data'] == 'true') {
                                oValidator.generalPurpose.getMessage(true, LANG['msg_002']);
                                popup.close('simplesample_delete_popup');
                                location.reload();
                            } else {
                                oValidator.generalPurpose.getMessage(false, LANG['msg_003']);
                                location.reload();
                            }
                        }
                };
                $.ajax(options);
            } else {
                sdk_message.show(LANG['msg_001'], 'warning')
            }
        }
};