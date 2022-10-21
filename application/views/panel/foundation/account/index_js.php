<script type="text/javascript">
    $(document).ready(function () {

        $(".update-account").click(function () {
            $formData = $(this).parent().parent().parent().serializeArray();
            $sendData = jQFormSerializeArrToJson($formData);
            $sendData['inputPersonId'] = $(this).data('person-id');
            $sendData['inputFoundationId'] = $("#inputFoundationId").val();
            toggleLoader();
            $.ajax({
                type: 'post',
                url: base_url + 'Foundation/doEditFoundationAdmin',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('اطلاعات نمایندگی تکراری ست', 'red');
                    toggleLoader();
                }
            });
        });
    });
</script>