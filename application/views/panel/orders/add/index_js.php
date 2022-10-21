<script type="text/javascript">
    $(document).ready(function () {
        $("#addOrder").click(function () {
            $inputOrderTitle = $.trim($("#inputOrderTitle").val());
            $inputFoundationId = $.trim($("#inputFoundationId").val());
            toggleLoader();
            $sendData = {
                'inputOrderTitle': $inputOrderTitle,
                'inputFoundationId': $inputFoundationId,
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doAdd',
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