<script type="text/javascript">
    $(document).ready(function () {
        $("#addOrderPlanTime").click(function () {
            $inputOrderPlanId = $.trim($("#inputOrderPlanId").val());
            $inputToolId = $.trim($("#inputToolId").val());
            $inputRecordTitle = $.trim($("#inputRecordTitle").val());
            $inputTimeId = $.trim($("#inputTimeId").val());
            $inputValuerId = $.trim($("#inputValuerId").val());
            $inputPersonIds = $.trim($("#inputPersonIds").val());
            $inputPersonIds = $inputPersonIds.replace('All,','');

            $err = "";
            $(".remove-person").each(function(){
                $buttonToolId = $(this).data('tool-id');
                $buttonValuerId = $(this).data('valuer-id');
                $buttonPersonId = $(this).data('person-id');
                $buttonPersonTitle = $(this).data('title');
                $selectedPerson =$inputPersonIds.split(',');
                for($i=0;$i<$selectedPerson.length;$i++){
                    if($inputToolId == $buttonToolId && $inputValuerId == $buttonValuerId && $selectedPerson[$i] == $buttonPersonId){
                        $err += "<li>";
                        $err += $buttonPersonTitle+ " قبلا به این ارزیاب اختصاص داده شده است. ";
                        $err += "</li>";
                    }
                }
            });

            if($err != ""){
                $err += "<li>";
                $err += "موارد را اصلاح کرده و مجددا ذخیره کنید";
                $err += "</li>";
                $(".alerts").hide().html($err).fadeIn();
                //return;
            }

            toggleLoader();
            $sendData = {
                'inputOrderPlanId': $inputOrderPlanId,
                'inputToolId': $inputToolId,
                'inputRecordTitle': $inputRecordTitle,
                'inputTimeId': $inputTimeId,
                'inputValuerId': $inputValuerId,
                'inputPersonIds': $inputPersonIds
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doPlanTableRecordsAdd',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    $result = jQuery.parseJSON(data);
                    notify($result['content'], $result['type']);
                    //reloadPage(3000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });
        });
        $(document).on('click', '.remove-person', function () {
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
                                'inputRecordId': $this.data('id'),
                                'inputRecordPersonId': $this.data('person-id'),
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doDeleteOrderPlanRecordPersonByRecordPerson',
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
                                'inputRecordId': $this.data('id')
                            }
                            $.ajax({
                                type: 'post',
                                url: base_url + 'Orders/doPlanTableRecordsDelete',
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
        $('#inputPersonIds').on('change', function(){
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val())?thisObj.val():[];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            var selectedOptionsLength = selectedOptions.length;

            if(isAllSelected == lastAllSelected){

                if($.inArray("All", selectedOptions) >= 0){
                    selectedOptionsLength -= 1;
                }

                if(allOptionsLength <= selectedOptionsLength){

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                }else{
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            }else{
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }
            $(this).data('all', isAllSelected);
        }).trigger('change');
        $(".person-editor").keypress(function(e){
            if(e.which == 13) {
                toggleLoader();
                $sendData = {
                    'inputPersonId': $(this).data('person-id'),
                    'inputColumn': $(this).data('column'),
                    'inputValue': $(this).text()
                }
                $.ajax({
                    type: 'post',
                    url: base_url + 'Person/doEditByColumn',
                    data: $sendData,
                    success: function (data) {
                        toggleLoader();
                        $result = jQuery.parseJSON(data);
                        notify($result['content'], $result['type']);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        toggleLoader();
                    }
                });
                return false;
            }
        });
    });
</script>