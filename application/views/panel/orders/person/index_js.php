<script type="text/javascript">
    $(document).ready(function () {
        $("#addOrderPerson").click(function () {
            $inputOrderId= $.trim($("#inputOrderId").val());
            $inputPersonFirstName = $.trim($("#inputPersonFirstName").val());
            $inputPersonLastName = $.trim($("#inputPersonLastName").val());
            $inputPersonNationalCode  = $.trim($("#inputPersonNationalCode").val());
            $inputPersonPhone = '0';
            $inputPersonCode = $.trim($("#inputPersonCode").val());
            $inputPersonPhone = $.trim($("#inputPersonPhone").val());

            $inputUsername = $inputPersonNationalCode;
            $inputPassword = $inputPersonNationalCode;

            if($inputPersonNationalCode =='' && $inputPersonCode ==''){
                notify('کد ملی یا شناسه سازمانی باید وارد شود', 'yellow');
                return false;
            }

            toggleLoader();
            $sendData = {
                'inputPersonFirstName': $inputPersonFirstName,
                'inputPersonLastName': $inputPersonLastName,
                'inputPersonNationalCode': $inputPersonNationalCode,
                'inputPersonCode': $inputPersonCode,
                'inputPersonPhone': $inputPersonPhone,
                'inputUsername': $inputUsername,
                'inputPassword': $inputPassword
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Person/doAdd',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $personId = jQuery.parseJSON(data);
                    $sendData = {
                        'inputOrderId': $inputOrderId,
                        'inputPersonId': $personId
                    }
                    $.ajax({
                        type: 'post',
                        url: base_url + 'Orders/doAddOrderPerson',
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
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });
        $(document).on('click', '.remove', function () {
            $this = $(this);
            $title = "<strong class='badge'> " + $this.data('title') + " </strong>";
            $.confirm({
                title: '',
                content: 'آیا از حذف '+ $title +' مطمئن هستید؟',
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
                                url: base_url + 'Orders/doDeleteOrderPerson',
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
                                    setTimeout(function(){
                                        if ($result['success']) {
                                            location.reload();
                                        }
                                    } , 1000);
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


        $(document).on('keypress', '.edit', function (e) {
            if(e.keyCode == 13){
                $inputPersonId= $(this).data('person-id');
                $inputColumn= $(this).data('info-type');
                $inputValue= $.trim($(this).text());
                toggleLoader();
                $sendData = {
                    'inputColumn': $inputColumn,
                    'inputValue': $inputValue,
                    'inputPersonId': $inputPersonId
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Person/doEditByColumn',
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
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notify('خطای ارتباط با سرور', 'red');
                        toggleLoader();
                    }
                });
                e.preventDefault();
            }
        });
    });
</script>