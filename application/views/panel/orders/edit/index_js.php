<script type="text/javascript">
    $(document).ready(function () {
        $("#editOrder").click(function () {
            $inputOrderId = $.trim($("#inputOrderId").val());
            $inputOrderTitle = $.trim($("#inputOrderTitle").val());
            $inputBreakContent = $.trim($("#inputBreakContent").val());
            $inputBreakTable = $.trim($("#inputBreakTable").val());
            $inputFoundationId = $.trim($("#inputFoundationId").val());
            $inputIsActive  = $.trim($("#inputIsActive").val());
            toggleLoader();
            $sendData = {
                'inputOrderId': $inputOrderId,
                'inputOrderTitle': $inputOrderTitle,
                'inputBreakContent': $inputBreakContent,
                'inputBreakTable': $inputBreakTable,
                'inputFoundationId': $inputFoundationId,
                'inputIsActive': $inputIsActive
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