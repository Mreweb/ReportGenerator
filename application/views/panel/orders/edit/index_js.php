<script type="text/javascript">
    $(document).ready(function () {
        $("#editOrder").click(function () {
            $inputOrderId = $.trim($("#inputOrderId").val());
            $inputOrderTitle = $.trim($("#inputOrderTitle").val());
            $inputCustomerId = $.trim($("#inputCustomerId").val());
            $inputFoundationId = $.trim($("#inputFoundationId").val());
            $inputManagerId  = $.trim($("#inputManagerId").val());
            $inputIsActive  = $.trim($("#inputIsActive").val());
            $inputIsAbilityBase  = $.trim($("#inputIsAbilityBase").val());
            toggleLoader();
            $sendData = {
                'inputOrderId': $inputOrderId,
                'inputOrderTitle': $inputOrderTitle,
                'inputCustomerId': $inputCustomerId,
                'inputFoundationId': $inputFoundationId,
                'inputManagerId': $inputManagerId,
                'inputIsActive': $inputIsActive,
                'inputIsAbilityBase': $inputIsAbilityBase
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doEdit',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    reloadPage(3000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });
    });
</script>