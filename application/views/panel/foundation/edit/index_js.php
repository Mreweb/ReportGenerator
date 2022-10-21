<script type="text/javascript">
    $(document).ready(function () {
        $("#editFoundation").click(function () {
            $inputFoundationId = $.trim($("#inputFoundationId").val());
            $inputFoundationTitle = $.trim($("#inputFoundationTitle").val());
            $inputFoundationOwnerTitle = $.trim($("#inputFoundationOwnerTitle").val());
            $inputFoundationOwnerPhone = $.trim($("#inputFoundationOwnerPhone").val());
            $inputFoundationAddress = $.trim($("#inputFoundationAddress").val());
            $inputIsActive = $.trim($("#inputIsActive").val());
            toggleLoader();
            $sendData = {
                'inputFoundationId': $inputFoundationId,
                'inputFoundationTitle': $inputFoundationTitle,
                'inputFoundationOwnerTitle': $inputFoundationOwnerTitle,
                'inputFoundationOwnerPhone': $inputFoundationOwnerPhone,
                'inputFoundationAddress': $inputFoundationAddress,
                'inputIsActive': $inputIsActive
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Foundation/doEdit',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    if($result['success']){
                        reloadPage(4000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای نامشخص', 'red');
                    toggleLoader();
                }
            });
        });
        /* End Update User Info */
    });
</script>