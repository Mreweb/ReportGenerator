<script type="text/javascript">
    $(document).ready(function () {

        $("#editTools").click(function () {
            $fileSrc = "";
            var form_data = new FormData();
            form_data.append("file", document.getElementById('inputDescriptionFile').files[0]);
            $.ajax({
                url: base_url + 'Home/uploadFile',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (data) {
                    $result = JSON.parse(data);
                    $fileSrc = $result['fileSrc'];
                    $inputToolId = $.trim($("#inputToolId").val());
                    $inputToolTitle = $.trim($("#inputToolTitle").val());
                    $inputToolType = $.trim($("#inputToolType").val());
                    $inputOrderId = $.trim($("#inputOrderId").val());
                    toggleLoader();
                    $sendData = {
                        'inputToolId': $inputToolId,
                        'inputToolTitle': $inputToolTitle,
                        'inputToolGuideFile': $fileSrc,
                        'inputToolType': $inputToolType,
                        'inputOrderId': $inputOrderId
                    }
                    $.ajax({
                        type: 'post',
                        url: base_url + 'Orders/doToolsEdit',
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


                },
                error: function (data) {
                    $result = JSON.parse(data);
                    notify($result['content'], $result['type']);
                    return false;
                }
            });


        });

    });
</script>