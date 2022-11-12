<script type="text/javascript">
    $(document).ready(function () {
        Chart.defaults.font.family = "Vazir";

        <?php
        foreach($TotalResult as $item) {
        if(!empty($item['personResult'])){
            $area = $item['area'];
            $areaItems = $item['areaItems'];
            $personResult = $item['personResult'];
            $Result = $item['Result'];
            $TableCount = $item['TableCount'];
            $areaItemsChunk = $item['areaItemsChunk'];
            $personResultChunk = $item['personResultChunk'];
            $ResultChunk = $item['ResultChunk'];
        ?>
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
                            echo $temp['FATScore'] . ",";
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
                            echo $temp['AVG'] . ",";
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
            /*plugins: [ChartDataLabels],*/
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold'
                    }
                }
            }
        });

        <?php } } ?>
    });
</script>