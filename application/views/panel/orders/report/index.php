<?php
$_DIR = base_url('assets/adminpanel/');
$CI =& get_instance();
?>
<script src="<?php echo $_DIR; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/ui/js/chartjs-3.7.1.js') ?>"></script>
<script src="<?php echo base_url('assets/ui/js/chartjs-plugin.js') ?>"></script>
<script src="<?php echo base_url('assets/ui/js/chartjs-data-labels.js') ?>"></script>
<link href="<?php echo $_DIR; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $_DIR; ?>plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet">
<link href="<?php echo $_DIR; ?>css/materialize.css" rel="stylesheet"/>
<link href="<?php echo $_DIR; ?>css/style.css" rel="stylesheet">
<style type="text/css">
    .row {
        margin-right: 0;
        margin-left: 0;
    }

    .rtl, .col-xs-12 {
        padding: 0;
    }

    .result-container {
        padding: 12px;
        margin: 0;
    }

    .area-info {
        display: inline-flex;
    }

    .area-info i {
        font-size: 50px;
        margin: 0px 5px;
    }

    .area-info b {
        font-size: 26px;
        margin: 10px 0;
    }

    .info strong {

    }

    .info b {
        background: #ffffa8 !important;
        padding: 6px 20px;
        display: inline-block;
        float: left;
        margin-bottom: 8px;
        border-radius: 5px;
        font-size: 14px;
        min-width: 300px;
    }

    .area-title {
        color: #0095ff !important;;
        font-size: 16px;
        margin: 0px;
        margin-bottom: 8px;
    }

    .area-content {
        text-align: justify;
        direction: revert;
        line-height: 20px;
        font-size: 12px;
    }

    .color-guid {
        display: inline-block;
        width: 100%;
    }

    .color-guid span {
        display: inline-block;
        width: 30px;
        border: 1px solid #9f9f9f !important;;
        float: left;
        height: 15px;
        float: left !important;
    }

    .level-1 {
        background-color: #FF0000 !important;
        color: #fff;
    }

    .level-2 {
        background-color: #ff6600 !important;
        color: #fff;
    }

    .level-3 {
        background-color: #ff9900 !important;
    }

    .level-4 {
        background-color: #FFCC00 !important;
    }

    .level-5 {
        background-color: #FFFF00 !important;
    }

    .level-6 {
        background-color: #ccff00 !important;
    }

    .level-7 {
        background-color: #99ff00 !important;
    }

    .level-8 {
        background-color: #66ff00 !important;
    }

    .level-9 {
        background-color: #33ff00 !important;
    }

    .level-10 {
        background-color: #57C84D !important;
    }
    table {
        width: 100% !important;
        margin-bottom: 10px;
    }
    .result-table tbody tr td,
    .result-table tbody tr th {
        padding: 2px;
        border: 1px solid #aaa;
        width: 16.5% !important;
        font-size: 14px;
    }

    .sidebar, .navbar {
        display: none;
    }

    section.content {
        margin: 0 0 0 0 !important;
    }

    body,
    .body,
    .container-fluid,
    .container,
    .card {
        padding: 0 !important;
        margin: 0 !important;
        direction: rtl;
        text-align: justify;
    }

    canvas {
        min-height: 100%;
        max-width: 100%;
        max-height: 100%;
        height: auto !important;
        width: auto !important;
    }

    @media print {
        .col-xs-12 {
            float: none;
            width: auto;
        }
        .break {
            display: block;
            width: 100%;
            clear: both;
            page-break-after: always;
            float: none !important;
            page-break-before: always;
            break-after: always;
            break-before: always;
        }
        .section {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .d-block {
            display: inline-block;
            width: 100%;
        }
    }




    .common {
        text-align: right;
    }

    .common span {
        float: right !important;
        width: auto;
        padding: 0;
        font-size: 8px;
        height: auto;
    }

    .common span b {
        padding: 6px 6px;
        display: inline-block;
        float: right;
    }

    .common span b.intro {
        background: #a6fca4;
        color: #000;
    }

    .common span b.title {
        background: #fadc63;
        color: #000;
    }

    .common span b.score {
        background: #fff3c4;
        color: #000;
    }


</style>
<input type="hidden" id="inputAreaId" <?php setInputValue($area['AreaId']); ?> />
    <p class="text-center" style="font-size: 18px;">
        بسمه تعالی
        <b style="float: left;font-size: 10px;margin: 0px 0px;position: absolute;left: 0;">
            شماره دوره:
            <strong class="text-danger">
                <?php echo $order['OrderTitle']; ?>
            </strong>
        </b>
    </p>
    <div class="col-xs-12 d-block">
        <span class="pull-right area-info">
            <i class="material-icons">spellcheck</i>
            <b>نتایج ارزیابی</b>
        </span>

        <span class="pull-left info">
            <b>
                نام و نام خانوادگی:
                <strong class="text-danger"><?php echo $person['FirstName'] . " " . $person['LastName']; ?></strong>
            </b>
            <br>
            <b>
                <strong class="text-danger"><?php echo $person['Tag']; ?></strong>
            </b>
        </span>
    </div>
    <div class="section d-block">
        <h3 class="area-title"><?php echo $area['AreaTitle']; ?></h3>
        <div class="area-content"><?php echo nl2br($area['AreaContent']); ?></div>
    </div>
    <?php if ($area['BreakContent'] == 1) { ?>
        <div class="break"></div>
    <?php } ?>
    <div class="section d-block">

        <?php


        $MaxScoreArray = array();
        foreach ($personResult as $sc) {
            $MaxScoreArray[] = $sc;
        }
        usort($MaxScoreArray, function ($a, $b) {
            return $a['FATScore'] < $b['FATScore'];
        });


        ?>


        <div class="col-xs-4 color-guid p-0 pull-right common" style="text-align: right">
            <?php
            if ($area['CommonFeatures'] == 1) { ?>
                <span>
                            <b class="intro">ویژگی های قالب</b>
                        </span>
                <?php for ($i = 0; $i < ($area['CommonFeaturesCount']); $i++) {
                    foreach ($areaItems as $areaItem) {
                        if ($areaItem['FATId'] == $MaxScoreArray[$i]['FATId']) { ?>
                            <span>
                                            <b class="title"><?php echo $areaItem['FATTitle']; ?></b>
                                            <b class="score"><?php echo round($MaxScoreArray[$i]['FATScore'], 2) ?></b>
                                        </span>
                        <?php }
                    }
                }
            }
            ?>
        </div>

        <div class="col-xs-8 color-guid p-0">
            <span class="level-1"></span>
            <span class="level-2"></span>
            <span class="level-3"></span>
            <span class="level-4"></span>
            <span class="level-5"></span>
            <span class="level-6"></span>
            <span class="level-7"></span>
            <span class="level-8"></span>
            <span class="level-9"></span>
            <span class="level-10"></span>
        </div>


        <div class="col-xs-12 result-table p-0">
            <?php for ($i = 0; $i < $TableCount; $i++) { ?>
                <?php
                $areaItemsTemp = $areaItemsChunk[$i];
                $personResultTemp = $personResultChunk[$i];
                $ResultTemp = $ResultChunk[$i];
                ?>
                <table>
                    <tr>
                        <td class="fit text-center">مولفه</td>
                        <?php foreach ($areaItemsTemp as $item) { ?>
                            <td class="fit text-center"><?php echo $item['FATTitle']; ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="fit text-center">نمره فرد</td>
                        <?php foreach ($personResultTemp as $item) { ?>
                            <td class="fit text-center <?php echo pipExamResultLevel($item['FATScore']); ?>"><?php echo $item['FATScore']; ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="fit text-center">میانگین سازمان</td>
                        <?php foreach ($ResultTemp as $item) { ?>
                            <td class="fit text-center   <?php echo pipExamResultLevel($item['AVG']); ?>"><?php echo round($item['AVG'], 2); ?></td>
                        <?php } ?>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <?php if ($area['BreakTable'] == 1) { ?>
        <div class="break"></div>
    <?php } ?>
    <div class="section d-block">
        <div class="col-xs-12 area-chart p-0"  style="border: 3px dashed #ccc;margin: 15px 0;">
            <div class="col-xs-12 result-chart" style="height: 350px;width: 100% !important;">
                <h3 class="area-title">نتایج</h3>
                <canvas id="ReghbatMinMaxAvgChart"
                        style="height: 350px;width: 100% !important;"></canvas>
            </div>
        </div>
    </div>
