<script type="text/javascript">
    $(document).ready(function () {
        Chart.defaults.font.family = "Vazir";
        var ReghbatMinMaxAvgChartCTX = document.getElementById("ReghbatMinMaxAvgChart");
        new Chart(ReghbatMinMaxAvgChartCTX, {
            type: 'bar',
            data: {
                labels: [<?php  foreach ($areaItems as $item) {  echo "'" . $item['FATTitle'] . "',"; }; ?>],
                datasets: [
                    {
                        label: "فرد",
                        data: [<?php  foreach ($personResult as $item) {  echo $item['FATScore'] . ","; }; ?>],
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
                        label: "سازمان",
                        fillColor: "red",
                        data: [<?php  foreach ($Result as $item) {  echo $item['AVG'] . ","; }; ?>],
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
    });
</script>