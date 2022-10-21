<script type="text/javascript">
    $(document).ready(function () {
        $("#update").click(function () {
            $sendData = [];
            $("[name='inputItem']").each(function () {
                if ($(this).is(':checked')) {
                    $sendData.push({
                        'inputAbilityId': $(this).data('ability-id'),
                        'inputMarkerId': $(this).data('marker-id'),
                        'inputToolId': $(this).data('tool-id'),
                        'inputOrderId': $("#inputOrderId").val()
                    });
                }
            });
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/doUpdateAbilityToolsRelation',
                data: { 'inputData' : JSON.stringify($sendData)},
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
        $("[name='inputItem']").click(function (e) {
            $this = $(this);
            if (!$this.is(':checked')) {
                $sendData = {
                    'inputAbilityId': $this.data('ability-id'),
                    'inputMarkerId': $this.data('marker-id'),
                    'inputToolId': $this.data('tool-id'),
                    'inputOrderId': $("#inputOrderId").val()
                };
                $.confirm({
                    title: '',
                    content: 'آیا از حذف '+ $this.data('title') +' مطمئن هستید؟',
                    buttons: {
                        specialKey: {
                            text: 'تایید',
                            btnClass: 'btn-blue',
                            action: function () {
                                toggleLoader();
                                $.ajax({
                                    type: 'post',
                                    url: base_url + 'Orders/doDeleteAbilityToolsRelation',
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
                                $this.prop('checked',true);
                            }
                        }
                    }
                });
            }
        });

        $tableOffset = $("table").offset().top;
        $(window).bind("scroll", function() {
            if($(document).scrollTop() > $tableOffset){
                var Offset = $(document).scrollTop() - $tableOffset+70;
                $("table thead").css('top',Offset).addClass('active');
            }
            else{
                $("table thead").css('top',0);
                $("table thead").css('top',Offset).removeClass('active');
            }
        });

    });
</script>