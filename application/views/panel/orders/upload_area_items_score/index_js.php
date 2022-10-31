<?php $ci =& get_instance(); ?>
<script type="text/javascript">
    $(document).ready(function () {

        $inputAttachmentSource = "";
        function readURL(input) {
            if (input.files && input.files[0] && input.files[0].name.match(/\.(xlsx)$/)) {
                $FileSize = input.files[0].size / 1024 / 1024;
                if ($FileSize < 8) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) { var file = e.target.result; };
                        reader.readAsDataURL(input.files[0]);
                        var file_data = input.files[0];
                        var form_data = new FormData();
                        form_data.append('file',file_data);
                        form_data.append('inputAreaId',$("#inputAreaId").val());
                        toggleLoader();
                        $.ajax({
                            url: base_url + 'Orders/doImportAreaScoreFile',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data) {
                                $result = JSON.parse(data);
                                notify($result['content'], $result['type']);
                                toggleLoader();
                            },
                            error: function (data) {
                            }
                        });
                    }
                }
                else {
                    notify("فایل شما باید کمتر از هشت مگابایت باشد", "red");
                }
            }
            else {
                notify("فرمت فایل نامعتبر است", "red");
            }
        }
        $("#file").change(function () {
            readURL(this);
        });
        $("#exportScoreFile").click(function(){
            $inputAreaId  = $.trim($("#inputAreaId").val());
            toggleLoader();
            $sendData = { 'inputAreaId' : $inputAreaId };
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doExportAreaScoreFile',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    window.open($result['fileName'],'new');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });


        $items = <?php echo $ci->config->item('defaultPageSize'); ?>;
        $itemsOnPage = <?php echo $ci->config->item('defaultPageSize'); ?>;
        $selectedPage = 1;
        $totalResultCount = 0;
        $hasPagination = false;
        function loadData(selectedPage = $selectedPage){
            toggleLoader();
            $sendData = {
                'inputAreaId': $("#inputAreaId").val(),
                'inputAreaItemsCount': $("#inputAreaItemsCount").val(),
                'pageIndex': selectedPage
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doOrderAreaScorePagination',
                data: $sendData,
                success: function (data) {
                    hideLoader();
                    $result = JSON.parse(data);
                    $(".table-rows").html($result['htmlResult']);
                    $totalResultCount = $result['count'];
                    if($hasPagination){
                        $(".simple-pagination").pagination('updateItems', $totalResultCount);
                    }
                    else{
                        $hasPagination = true;
                        $(".simple-pagination").pagination({
                            items: $totalResultCount,
                            itemsOnPage: $itemsOnPage,
                            cssStyle: 'compact-theme',
                            prevText: 'قبلی',
                            nextText: 'بعدی',
                            onPageClick: function (pageNum, e) {
                                e.preventDefault();
                                loadData(pageNum);
                            }
                        });
                    }
                }
            });
        }
        $(document).ready(function(){
            loadData();
            $("#searchButton").click(function () {
                loadData(1);
            });

        });

    });
</script>