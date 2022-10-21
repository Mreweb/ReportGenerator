<script type="text/javascript">
    $(document).ready(function () {

        $("#uploadComponent").click(function (e) {
            e.preventDefault();
            var form_data = new FormData();
            var totalfiles = document.getElementById('inputFile').files.length;
            if (totalfiles >= 0) {
                form_data.append("inputFile", document.getElementById('inputFile').files[0]);
                $.ajax({
                    url: base_url + 'Orders/doUploadToolComponent/'+<?php echo $tool['ToolId']; ?>,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (data) {
                        $result = JSON.parse(data);
                        notify($result['content'], $result['type']);
                        location.reload();
                    },
                    error: function (data) {
                        $result = JSON.parse(data);
                        notify($result['content'], $result['type']);
                    },
                })
            }
            else {
                notify('حداقل یک فایل انتخاب کنید', 'red');
            }
        });1
        $(document).on('click', '.remove', function () {
            $this = $(this);
            $title = "<strong class='badge'> " + $this.data('title') + " </strong>";
            $.confirm({
                title: '',
                content: 'آیا از حذف ' + $title + ' مطمئن هستید؟',
                buttons: {
                    specialKey: {
                        text: 'تایید',
                        btnClass: 'btn-blue',
                        action: function () {
                            toggleLoader();
                            $sendData = {
                                'inputComponentId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doDeleteComponent',
                                data: $sendData,
                                success: function (data) {
                                    toggleLoader();
                                    $result = jQuery.parseJSON(data);
                                    iziToast.show({
                                        title: $result['content'],
                                        color: $result['type'],
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    setTimeout(function () {
                                        if ($result['success']) {
                                            location.reload();
                                        }
                                    }, 1000);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    iziToast.show({
                                        title: 'خطای ارتباط با سرور.دقایقی دیگر تلاش کنید',
                                        color: 'red',
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    toggleLoader();
                                }
                            });
                        }
                    },
                    alphabet: {
                        text: 'انصراف',
                        action: function () {
                            //$.alert('A or B was pressed');
                        }
                    }
                }
            });
        });


        if(localStorage.getItem('inputAbilityMarker') !== undefined){
            $("#inputAbilityMarker").val(localStorage.getItem('inputAbilityMarker'));
        }
        if(localStorage.getItem('inputComponentId') !== undefined){
            $("#inputComponentId").val(localStorage.getItem('inputComponentId'));
        }
        if(localStorage.getItem('inputWeight') !== undefined){
            $("#inputWeight").val(localStorage.getItem('inputWeight'));
        }



        $("#addComponentAbilityRelation").click(function (e) {

            $inputAbilityMarker = $.trim($("#inputAbilityMarker").val());
            $inputAbilityId = $("#inputAbilityMarker option:selected").data('ability-id');
            $inputToolId = $.trim($("#inputToolId").val());
            $inputComponentId = $.trim($("#inputComponentId").val());
            $inputWeight = $.trim($("#inputWeight").val());

            localStorage.setItem('inputAbilityId',$inputAbilityId);
            localStorage.setItem('inputAbilityMarker',$inputAbilityMarker);
            localStorage.setItem('inputComponentId',$inputComponentId);
            localStorage.setItem('inputWeight',$inputWeight);

            if($inputWeight == ''){
                $inputWeight = 1;
            }

            $sendData = {
                'inputAbilityMarker': $inputAbilityMarker,
                'inputAbilityId': $inputAbilityId,
                'inputToolId': $inputToolId,
                'inputComponentId': $inputComponentId,
                'inputWeight': $inputWeight
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doAddComponentMarkerRelation',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });

        });
        $(document).on('click', '.remove-relation', function () {
            $this = $(this);
            $title = "<strong class='badge'> " + $this.data('title') + " </strong>";
            $.confirm({
                title: '',
                content: 'آیا از حذف ' + $title + ' مطمئن هستید؟',
                buttons: {
                    specialKey: {
                        text: 'تایید',
                        btnClass: 'btn-blue',
                        action: function () {
                            toggleLoader();
                            $sendData = {
                                'inputRowId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doDeleteComponentMarker',
                                data: $sendData,
                                success: function (data) {
                                    toggleLoader();
                                    $result = jQuery.parseJSON(data);
                                    iziToast.show({
                                        title: $result['content'],
                                        color: $result['type'],
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    setTimeout(function () {
                                        if ($result['success']) {
                                            location.reload();
                                        }
                                    }, 1000);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    iziToast.show({
                                        title: 'خطای ارتباط با سرور.دقایقی دیگر تلاش کنید',
                                        color: 'red',
                                        zindex: 9060,
                                        position: 'topLeft'
                                    });
                                    toggleLoader();
                                }
                            });
                        }
                    },
                    alphabet: {
                        text: 'انصراف',
                        action: function () {
                            //$.alert('A or B was pressed');
                        }
                    }
                }
            });
        });


        $("#uploadScoreComponent").click(function (e) {
            e.preventDefault();
            iziToast.show({
                title: 'لطفا تا نمایش پیام بعدی صبر کنید',
                color: 'yellow',
                zindex: 9060,
                position: 'topLeft'
            });
            var form_data = new FormData();
            var totalfiles = document.getElementById('inputFile').files.length;
            if (totalfiles >= 0) {
                form_data.append("inputFile", document.getElementById('inputScoreFile').files[0]);
                $.ajax({
                    url: base_url + 'Orders/doUploadScoreComponent/'+<?php echo $tool['ToolId']; ?>,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (data) {
                        $result = JSON.parse(data);
                        notify($result['content'], $result['type']);
                        //location.reload();
                    },
                    error: function (data) {
                        $result = JSON.parse(data);
                        notify($result['content'], $result['type']);
                    },
                })
            }
            else {
                notify('حداقل یک فایل انتخاب کنید', 'red');
            }
        });

    });
</script>