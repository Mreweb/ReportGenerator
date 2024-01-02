<script type="text/javascript">
    $(document).ready(function () {
        Chart.defaults.font.family = "Vazir";
        <?php
        foreach($TotalResult as $item) {
        if ($item['area']['Tanasob'] == 1) {
            if(!empty($item['personResult'])){

            $hasScore = false;
            foreach ($item['personResult'] as $chunk) {
                if ($chunk['FATScore'] != null) {
                    $hasScore = true;
                }
            }

            $area = $item['area'];
            $areaItems = $item['areaItems'];
            $personResult = $item['personResult'];
            $Result = $item['Result'];
            $TableCount = $item['TableCount'];
            $areaItemsChunk = $item['areaItemsChunk'];
            $personResultChunk = $item['personResultChunk'];
            $ResultChunk = $item['ResultChunk'];
        if ($hasScore) {
            ?>
            console.log("ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>");
            var ReghbatMinMaxAvgChartCTX = document.getElementById("ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>");
            new Chart(ReghbatMinMaxAvgChartCTX, {
                type: 'bar',
                data: {
                    labels: [<?php  foreach ($areaItems as $temp) {
                        echo "'" . $temp['FATTitle'] . "',";
                    }; ?>],
                    datasets: [
                        {
                            label: "فرد",
                            data: [<?php  foreach ($personResult as $temp) {
                                echo round($temp['FATScore']) . ",";
                            }; ?>],
                            backgroundColor: [
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                                'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            ]
                        },
                        {
                            label: "میانگین سازمان",
                            fillColor: "red",
                            data: [<?php  foreach ($Result as $temp) {
                                echo round($temp['AVG']) . ",";
                            }; ?>],
                            backgroundColor: [
                                'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                                'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                                'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                                'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                            ]
                        }
                    ]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: true,
                    scale: {
                        min: 0,
                        max: 100,
                        ticks: {
                            showLabelBackdrop: false,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels],
            });

    <?php
            }
            }
            }
        } ?>
        <?php
        foreach($TotalResult as $item) {
        if ($item['area']['Tanasob'] == 0) {
        if(!empty($item['personResult'])){

        $hasScore = false;
        foreach ($item['personResult'] as $chunk) {
            if ($chunk['FATScore'] != null) {
                $hasScore = true;
            }
        }

        $area = $item['area'];
        $areaItems = $item['areaItems'];
        $personResult = $item['personResult'];
        $Result = $item['Result'];
        $TableCount = $item['TableCount'];
        $areaItemsChunk = $item['areaItemsChunk'];
        $personResultChunk = $item['personResultChunk'];
        $ResultChunk = $item['ResultChunk'];
        if ($hasScore) {
        ?>
        console.log("ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>");
        var ReghbatMinMaxAvgChartCTX = document.getElementById("ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>");
        new Chart(ReghbatMinMaxAvgChartCTX, {
            type: 'bar',
            data: {
                labels: [<?php  foreach ($areaItems as $temp) {
                    echo "'" . $temp['FATTitle'] . "',";
                }; ?>],
                datasets: [
                    {
                        label: "فرد",
                        data: [<?php  foreach ($personResult as $temp) {
                            echo round($temp['FATScore']) . ",";
                        }; ?>],
                        backgroundColor: [
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                            'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)', 'rgba(100, 149, 237,0.8)',
                        ]
                    },
                    {
                        label: "میانگین سازمان",
                        fillColor: "red",
                        data: [<?php  foreach ($Result as $temp) {
                            echo round($temp['AVG']) . ",";
                        }; ?>],
                        backgroundColor: [
                            'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                            'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                            'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                            'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)', 'rgba(100, 255, 0,0.8)',
                        ]
                    }
                ]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                scale: {
                    min: 0,
                    max: 100,
                    ticks: {
                        showLabelBackdrop: false,
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        });

        <?php
        }
        }
        }
        } ?>
    });
    document.title = '<?php echo $person["Tag"]; ?>-<?php echo $person['FirstName'] . " " . $person['LastName']; ?>';
    document.title = '<?php echo $person["Tag"]; ?>-<?php echo $person['FirstName'] . " " . $person['LastName']; ?>';


    $("td").each(function (){
        if($(this).text() == '0'){
            $(this).text('-');
        }
    });

    $(".break").each(function (){
        $(this).next('.break').remove();
    });

</script>