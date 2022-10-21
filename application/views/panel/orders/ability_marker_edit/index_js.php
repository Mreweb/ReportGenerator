<script type="text/javascript">
    $(document).ready(function () {
        $("#editMarker").click(function () {
            $inputMarkerId           = $.trim($("#inputMarkerId").val());
            $inputMarkerTitle      = $.trim($("#inputMarkerTitle").val());
            toggleLoader();
            $sendData = {
                'inputMarkerId': $inputMarkerId,
                'inputMarkerTitle': $inputMarkerTitle
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doMarkerEdit',
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