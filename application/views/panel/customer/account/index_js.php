<script type="text/javascript">
    $(document).ready(function () {

        $(".update-account").click(function () {
            $formData = $(this).parent().parent().parent().serializeArray();
            $sendData = jQFormSerializeArrToJson($formData);
            $sendData['inputPersonId'] = $(this).data('person-id');
            $sendData['inputCustomerId'] = $("#inputCustomerId").val();
            toggleLoader();
            $.ajax({
                type: 'post',
                url: base_url + 'Customer/doEditCustomerAdmin',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطا در برقراری ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });
    });
</script>