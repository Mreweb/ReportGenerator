<script type="text/javascript">
    (function($,window,document,undefined){var pluginName="table2excel",defaults={exclude:".noExl",name:"Table2Excel",filename:"table2excel",fileext:".xls",exclude_img:true,exclude_links:true,exclude_inputs:true,preserveColors:false};function Plugin(element,options){this.element=element;this.settings=$.extend({},defaults,options);this._defaults=defaults;this._name=pluginName;this.init()}Plugin.prototype={init:function(){var e=this;var utf8Heading='<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';e.template={head:'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">'+utf8Heading+"<head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>",sheet:{head:"<x:ExcelWorksheet><x:Name>",tail:"</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>"},mid:"</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>",table:{head:"<table>",tail:"</table>"},foot:"</body></html>"};e.tableRows=[];var additionalStyles="";var compStyle=null;$(e.element).each(function(i,o){var tempRows="";$(o).find("tr").not(e.settings.exclude).each(function(i,p){additionalStyles="";if(e.settings.preserveColors){compStyle=getComputedStyle(p);additionalStyles+=(compStyle&&compStyle.backgroundColor?"background-color: "+compStyle.backgroundColor+";":"");additionalStyles+=(compStyle&&compStyle.color?"color: "+compStyle.color+";":"")}tempRows+="<tr style='"+additionalStyles+"'>";$(p).find("td,th").not(e.settings.exclude).each(function(i,q){additionalStyles="";if(e.settings.preserveColors){compStyle=getComputedStyle(q);additionalStyles+=(compStyle&&compStyle.backgroundColor?"background-color: "+compStyle.backgroundColor+";":"");additionalStyles+=(compStyle&&compStyle.color?"color: "+compStyle.color+";":"")}var rc={rows:$(this).attr("rowspan"),cols:$(this).attr("colspan"),flag:$(q).find(e.settings.exclude)};if(rc.flag.length>0){tempRows+="<td> </td>"}else{tempRows+="<td";if(rc.rows>0){tempRows+=" rowspan='"+rc.rows+"' "}if(rc.cols>0){tempRows+=" colspan='"+rc.cols+"' "}if(additionalStyles){tempRows+=" style='"+additionalStyles+"'"}tempRows+=">"+$(q).html()+"</td>"}});tempRows+="</tr>"});if(e.settings.exclude_img){tempRows=exclude_img(tempRows)}if(e.settings.exclude_links){tempRows=exclude_links(tempRows)}if(e.settings.exclude_inputs){tempRows=exclude_inputs(tempRows)}e.tableRows.push(tempRows)});e.tableToExcel(e.tableRows,e.settings.name,e.settings.sheetName)},tableToExcel:function(table,name,sheetName){var e=this,fullTemplate="",i,link,a;e.format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p]})};sheetName=typeof sheetName==="undefined"?"Sheet":sheetName;e.ctx={worksheet:name||"Worksheet",table:table,sheetName:sheetName};fullTemplate=e.template.head;if($.isArray(table)){Object.keys(table).forEach(function(i){fullTemplate+=e.template.sheet.head+sheetName+i+e.template.sheet.tail})}fullTemplate+=e.template.mid;if($.isArray(table)){Object.keys(table).forEach(function(i){fullTemplate+=e.template.table.head+"{table"+i+"}"+e.template.table.tail})}fullTemplate+=e.template.foot;for(i in table){e.ctx["table"+i]=table[i]}delete e.ctx.table;var isIE=navigator.appVersion.indexOf("MSIE 10")!==-1||(navigator.userAgent.indexOf("Trident")!==-1&&navigator.userAgent.indexOf("rv:11")!==-1);if(isIE){if(typeof Blob!=="undefined"){fullTemplate=e.format(fullTemplate,e.ctx);fullTemplate=[fullTemplate];var blob1=new Blob(fullTemplate,{type:"text/html"});window.navigator.msSaveBlob(blob1,getFileName(e.settings))}else{txtArea1.document.open("text/html","replace");txtArea1.document.write(e.format(fullTemplate,e.ctx));txtArea1.document.close();txtArea1.focus();sa=txtArea1.document.execCommand("SaveAs",true,getFileName(e.settings))}}else{var blob=new Blob([e.format(fullTemplate,e.ctx)],{type:"application/vnd.ms-excel"});window.URL=window.URL||window.webkitURL;link=window.URL.createObjectURL(blob);a=document.createElement("a");a.download=getFileName(e.settings);a.href=link;document.body.appendChild(a);a.click();document.body.removeChild(a)}return true}};function getFileName(settings){return(settings.filename?settings.filename:"table2excel")}function exclude_img(string){var _patt=/(\s+alt\s*=\s*"([^"]*)"|\s+alt\s*=\s*'([^']*)')/i;return string.replace(/<img[^>]*>/gi,function myFunction(x){var res=_patt.exec(x);if(res!==null&&res.length>=2){return res[2]}else{return""}})}function exclude_links(string){return string.replace(/<a[^>]*>|<\/a>/gi,"")}function exclude_inputs(string){var _patt=/(\s+value\s*=\s*"([^"]*)"|\s+value\s*=\s*'([^']*)')/i;return string.replace(/<input[^>]*>|<\/input>/gi,function myFunction(x){var res=_patt.exec(x);if(res!==null&&res.length>=2){return res[2]}else{return""}})}$.fn[pluginName]=function(options){var e=this;e.each(function(){if(!$.data(e,"plugin_"+pluginName)){$.data(e,"plugin_"+pluginName,new Plugin(this,options))}});return e}})(jQuery,window,document);


    $(document).ready(function () {
        $("#export").click(function () {

            $titles = [];
            $("thead tr td").each(function(){
                $titles.push($(this).text());
            });

            $Allresult = [];
            $("tbody tr").each(function(){
                $result = [];
                $tr = $(this);
                $tr.find('td').each(function(){
                    $result.push($.trim($(this).find('b.score').text()));
                });
                $Allresult.push($result);
            });
            toggleLoader();
            $sendData = {
                'titles': JSON.stringify($titles),
                'result': JSON.stringify($Allresult)
            }
            $.ajax({
                type: 'post',
                url: base_url + 'Orders/exportResultExcel',
                data: $sendData,
                success: function (data) {
                    toggleLoader();
                    console.log(data);
                    location.href = data;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notify('خطای ارتباط با سرور', 'red');
                    toggleLoader();
                }
            });

            /*$("#table2excel label").remove();
            $("#table2excel").table2excel({
                name: "<?php echo $order['OrderTitle']; ?>",
                filename: "<?php echo $order['OrderTitle']; ?>", //do not include extension
                fileext: ".xlsx" // file extension
            });*/
        });
        /*----------------------------------------------*/
        var myChart = document.getElementById('myChart');
        data = {
            datasets: [{
                data: ['<?php echo $FailedPersonCount; ?>', '<?php echo $AcceptedPersonCount; ?>'], /* First item for losers  ,  second for winners */
                backgroundColor: ["#fb483a", "#2b982b"]
            }],
            labels: [
                'رد',
                'قبول'
            ]
        };
        new Chart(myChart, {
            type: 'doughnut',
            data: data,
            options: {
                legend: {
                    labels: {
                        fontFamily: "Vazir"
                    }
                }
            }

        });
        /*----------------------------------------------*/
        /*----------------------------------------------*/
        var myRadarChart = document.getElementById('myRadarChart');
        var myRadarChartData = {
            labels: [<?php foreach ($AbilityMinMaxAvg as $item) { echo "'" . $item['AbilityTitle'] . "',";} ?>],
            datasets: [{
                label: "حداقل",
                backgroundColor: "rgba(200,0,0,0.2)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['MIN'][0]['MIN'] . "',";
                } ?>]
            }, {
                label: "حداکثر",
                backgroundColor: "rgba(250,180,150,0.2)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['MAX'][0]['MAX'] . "',";
                } ?>]
            }, {
                label: "میانگین",
                backgroundColor: "rgba(90,255,200,0.2)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['AVG'][0]['AVG'] . "',";
                } ?>]
            }]
        };
        new Chart(myRadarChart, {
            type: 'radar',
            data: myRadarChartData,
            options: {
                legend: {
                    labels: {
                        fontFamily: "Vazir",
                        defaultFontFamily: "Vazir",
                    }
                },
                scale: {
                    angleLines: {
                        display: false
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 100
                    }
                }
            }

        });
        /*----------------------------------------------*/
        /*----------------------------------------------*/
        var myBarChart = document.getElementById('myBarChart');
        var myBarChartData = {
            labels: [<?php foreach ($AbilityMinMaxAvg as $item) {
                echo "'" . $item['AbilityTitle'] . "',";
            } ?>],
            datasets: [{
                label: "حداقل",
                backgroundColor: "rgba(200,0,0)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['MIN'][0]['MIN'] . "',";
                } ?>]
            }, {
                label: "حداکثر",
                backgroundColor: "rgba(250,180,150)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['MAX'][0]['MAX'] . "',";
                } ?>]
            }, {
                label: "میانگین",
                backgroundColor: "rgba(90,255,200)",
                data: [<?php foreach ($AbilityMinMaxAvg as $item) {
                    echo "'" . $item['AVG'][0]['AVG'] . "',";
                } ?>]
            }]
        };
        new Chart(myBarChart, {
            type: 'bar',
            data: myBarChartData,
            options: {
                responsive:true,
                maintainAspectRatio: true,
                scales: {
                    xAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }]
                }
            }

        });
        /*----------------------------------------------*/

        /*----------------------------------------------*/
        <?php
        $index = -1;
        foreach ($orderPerson as $op) {
            $index += 1;
            $avgAll = array();
            foreach ($orderModelAbility as $item) {
                $avg = array();
                foreach ($op['score'] as $sc) {
                    if ($sc['AbilityId'] == $item['AbilityId']) {
                        if ($sc['PlanManagerAVGScore'] > 0) {
                            array_push($avg, $sc['PlanManagerAVGScore']);
                        }
                    }
                }
                $temp = round(array_sum($avg) / sizeof($avg));
                if (is_nan($temp)) {
                } else {
                    array_push($avgAll, $temp);
                }
            }
            if (is_nan(array_sum($avgAll) / sizeof($avgAll))) {
                $orderPerson[$index]['AVGAllScore'] = 0;
            }
            else {
                $orderPerson[$index]['AVGAllScore'] = round(array_sum($avgAll) / sizeof($avgAll));
            }
        }
        ?>
        var myAllAbilityBarChart = document.getElementById('myAllAbilityBarChart');
        var myAllBarChartData = {
            labels: [<?php foreach ($orderPerson as $op) {
                echo "'" . $op['PersonFirstName'] . " " . $op['PersonLastName'] . "',";
            } ?>],
            datasets: [{
                label: "میانگین نمرات شایستگی",
                backgroundColor: '#5e9cc3',
                data: [<?php foreach ($orderPerson as $op) {
                    echo $op['AVGAllScore'] . ",";
                } ?>]
            }]
        };
        new Chart(myAllAbilityBarChart, {
            type: 'horizontalBar',
            data: myAllBarChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }]
                }
            }

        });
        /*----------------------------------------------*/

        /*----------------------------------------------*/
        <?php foreach ($orderModelAbility as $item) { ?>
        var mySingleAbilityBarChart<?php echo $item['AbilityId']; ?> = document.getElementById('mySingleAbilityBarChart-<?php echo $item['AbilityId']; ?>');
        var myAllBarChartData<?php echo $item['AbilityId']; ?> = {
            labels: [<?php foreach ($orderPerson as $op) {echo "'" . $op['PersonFirstName'] . " " . $op['PersonLastName'] . "',";} ?>],
            datasets: [{
                label: "<?php echo $item['AbilityTitle']; ?>",
                backgroundColor: '#5e9cc3',
                data: [<?php
                    foreach ($orderPerson as $op) {
                        $avgAll = array();
                        $avg = array();
                        foreach ($op['score'] as $sc) {
                            if ($sc['AbilityId'] == $item['AbilityId']) {
                                if ($sc['PlanManagerAVGScore'] > 0) {
                                    array_push($avg, $sc['PlanManagerAVGScore']);
                                }
                            }
                        }
                        $temp = round(array_sum($avg) / sizeof($avg));
                        if (is_nan($temp)) {
                            echo "0,";
                        } else {
                            echo $temp . ",";
                        }
                    } ?>]
            }]
        };
        new Chart(mySingleAbilityBarChart<?php echo $item['AbilityId']; ?>, {
            type: 'horizontalBar',
            data: myAllBarChartData<?php echo $item['AbilityId']; ?>,
            options: {
                responsive:true,
                maintainAspectRatio: true,
                scales: {
                    title: {
                        font: {
                            size: 16,
                            family:'vazir'
                        }
                    },
                    xAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontFamily: "Vazir",
                            beginAtZero: true
                        }
                    }]
                }
            }

        });
        <?php } ?>
        /*----------------------------------------------*/

    });
</script>