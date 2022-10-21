<script type="text/javascript">
    $(document).ready(function () {
        $("#editOrder").click(function () {
            $inputOrderId = $.trim($("#inputOrderId").val());
            $inputModelTitle = $.trim($("#inputModelTitle").val());
            $inputModelId = $.trim($("#inputModelId").val());
            toggleLoader();
            $sendData = {
                'inputOrderId': $inputOrderId,
                'inputModelId': $inputModelId,
                'inputModelTitle': $inputModelTitle
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doModelEdit',
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