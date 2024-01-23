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
            background: #e8e895 !important;
            padding: 6px 15px;
            display: inline-flex;
            float: right;
        }

        .info strong.dore {
            background: #fff !important;
            color: #000 !important;
            font-size: 10px;
            padding: 9px;
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
            color: #0095ff !important;
            font-size: 20px;
            margin: 0px;
            margin-bottom: 8px;
        }

        .area-content {
            text-align: justify;
            direction: rtl;
            line-height: 20px;
            font-size: 11px;
        }

        .color-guid {
            display: inline-block;
            /*width: 100%;*/
            text-align: left;
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
        / padding: 2 px;
            border: 1px solid #aaa;
            width: 14.2% !important;
            font-size: 12px;

            /*padding: 2px;
            border: 1px solid #aaa;
            font-size: 12px;*/
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

            background: #a6fca4 !important;
            color: #000 !important;
        }

        .common span b.title {
            background: #fadc63 !important;
            color: #000 !important;
        }

        .common span b.score {
            background: #fff3c4 !important;
            color: #000 !important;
        }

        .d-block {
            display: inline-block;
            width: 100%;
        }


        table .fit {
            width: 1%;
            white-space: normal;
            text-align: center;
            min-width: 60px;
        }


        @media print {
            .col-xs-12 {
                float: none;
                width: auto;
            }

            .section {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .d-block {
                display: inline-block;
                width: 100%;
            }

            .break {
                /* display: inline-block;
                 width: 100%;
                 clear: both;*/
                page-break-after: always;
                float: none !important;
                /*page-break-before: always;*/
                /*break-after: always;
                break-before: always;*/
            }
        }

    </style>

    <div class="col-xs-12 d-block">
        <span class="pull-right area-info">
            <i class="material-icons">spellcheck</i>
            <b>نتایج</b>
        </span>
        <span class="pull-left info">
                <strong class="text-danger">
                     نام و نام خانوادگی:
                    <?php echo $person['FirstName'] . " " . $person['LastName']; ?>
                </strong>
                <strong class="text-danger">
                    <?php echo $person['Tag']; ?>
                </strong>
              <strong class="text-danger dore">
                  نسخه:
                  <?php echo $order['OrderTitle']; ?>
              </strong>
        </span>
    </div>
<?php
foreach ($TotalResult as $item) {
    if ($item['area']['Tanasob'] == 0) {
        if (!empty($item['personResult'])) { ?>
            <?php
            $area = $item['area'];
            $TableCount = $item['TableCount'];
            $areaItemsChunk = $item['areaItemsChunk'];
            $personResultChunk = $item['personResultChunk'];
            $ResultChunk = $item['ResultChunk'];
            $MaxScoreArray = array();
            $hasScore = false;
            foreach ($item['personResultChunk'] as $chunk) {
                foreach ($chunk as $sc) {
                    $MaxScoreArray[] = $sc;
                    if ($sc['FATScore'] != null) {
                        $hasScore = true;
                    }
                }
            }
            usort($MaxScoreArray, function ($a, $b) {
                return $a['FATScore'] < $b['FATScore'];
            });
            ?>
            <?php if ($hasScore) { ?>
                <div class="section d-block">
                    <h3 class="area-title"><?php echo $area['AreaTitle']; ?></h3>
                    <div class="area-content"
                         style="line-height: 25px;font-size:<?php echo $area['BreakContentFont']; ?>px"><?php echo nl2br($area['AreaContent']); ?></div>
                </div>
                <?php if ($area['BreakContent'] == 1) {
                    echo '<div class="break"></div>';
                } ?>
                <div class="section d-block">
                    <div class="col-xs-12 color-guid p-0 pull-right common"
                         style="text-align: right;margin-bottom:8px;">
                        <?php if ($item['area']['CommonFeatures'] == 1) { ?>
                            <span style="font-size:<?php echo $area['BreakTableFont']; ?>px"><b class="intro">ویژگی های برجسته</b></span>
                            <?php for ($i = 0; $i < ($item['area']['CommonFeaturesCount']); $i++) {
                                foreach ($item['areaItems'] as $areaItem) {
                                    if ($areaItem['FATId'] == $MaxScoreArray[$i]['FATId']) { ?>
                                        <span style="font-size:<?php echo $area['BreakTableFont']; ?>px">
                                            <b class="title"><?php echo $areaItem['FATTitle']; ?></b>
                                            <b class="score"
                                               style="display: none;"><?php echo round($MaxScoreArray[$i]['FATScore'], 2) ?></b>
                                        </span>
                                    <?php }
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 color-guid p-0 pull-left">
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
                        <?php for ($i = 0; $i < $TableCount; $i++) {
                            $areaItemsTemp = $areaItemsChunk[$i];
                            $personResultTemp = $personResultChunk[$i];
                            $ResultTemp = $ResultChunk[$i];
                            ?>
                            <table style="margin: 15px 0;">
                                <tr>
                                    <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                        class="fit text-center">
                                        مولفه
                                    </td>
                                    <?php foreach ($areaItemsTemp as $temp) { ?>
                                        <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                            class="fit text-center"><?php echo $temp['FATTitle']; ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                        class="fit text-center">
                                        نمره فرد
                                    </td>
                                    <?php foreach ($personResultTemp as $temp) { ?>
                                        <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                            class="fit text-center <?php echo pipExamResultLevel($temp['FATScore']); ?>"><?php echo round($temp['FATScore'], 2); ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                        class="fit text-center">
                                        میانگین سازمان
                                    </td>
                                    <?php foreach ($ResultTemp as $temp) { ?>
                                        <td style="font-size:<?php echo $area['BreakTableFont']; ?>px"
                                            class="fit text-center   <?php echo pipExamResultLevel($temp['AVG']); ?>"><?php echo round($temp['AVG'], 2); ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($area['BreakTable'] == 1) {
                    echo '<div class="break"></div>';
                } ?>
                <div class="section d-block">
                    <div class="col-xs-12 area-chart p-0" style="border: 3px dashed #ccc;margin: 15px 0;">
                        <div class="col-xs-12 result-chart" style="height: 250px;width: 100% !important;">
                            <canvas id="ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>"
                                    style="height: 250px;width: 100% !important;"></canvas>
                        </div>
                    </div>
                </div>
                <?php if ($area['BreakChart'] == 1) {
                    echo '<div class="break"></div>';
                } ?>
            <?php }
        }
    }
}
?>
    <div class="section d-block">
        <?php

        $tanasobIndex = 0;
        $tanasobHasContentBreak = false;
        /*Print Descriptions*/
        foreach ($TotalResult as $item) {
            if ($item['area']['Tanasob'] == 1) {
                if (!empty($item['personResult'])) { ?>
                    <?php if ($tanasobIndex == 0) {
                        $tanasobIndex += 1; ?>
                        <h3 class="area-title"
                            style="color: #0095ff !important;font-size: 16px;display: inline-block;width: 100%;margin: 15px 0;">
                            تناسب</h3>
                    <?php } ?>

                    <?php
                    $area = $item['area'];
                    $TableCount = $item['TableCount'];
                    $areaItemsChunk = $item['areaItemsChunk'];
                    $personResultChunk = $item['personResultChunk'];
                    $ResultChunk = $item['ResultChunk'];

                    if ($area['BreakContent'] == 1) {
                        $tanasobHasContentBreak = true;
                    }
                    ?>
                    <div class="area-content"
                         style="line-height: 20px;margin-bottom: 10px;"><?php echo nl2br($area['AreaContent']); ?></div>
                <?php } ?>
            <?php }
        } ?>
    </div>
    <?php if ($tanasobHasContentBreak) {
        echo '<div class="break"></div>';
    } ?>


<?php
$TableCount = 0;
foreach ($TotalResult as $item) {
    if ($item['area']['Tanasob'] == 1) {
        if (!empty($item['personResult'])) {
            $TableCount = $item['TableCount'];
        }
    }
}
?>

<?php
$areaPrinted = false;
$loop = -1;
$tablePrintCount = 0;
$tanasobHasTableBreak = false;
while ($loop < $TableCount - 1) {
    $loop += 1;
    $moalefePrinted = false;
    foreach ($TotalResult as $item) {
        if ($item['area']['Tanasob'] == 1) {
            if (!empty($item['personResult'])) {
                $area = $item['area'];
                $TableCount = $item['TableCount'];
                $areaItemsChunk = $item['areaItemsChunk'];
                $personResultChunk = $item['personResultChunk'];
                $ResultChunk = $item['ResultChunk'];
                ?>
                <div class="section d-block">

                    <?php
                    if ($TableCount > 0) {
                        if ($tablePrintCount == 0) {
                            $tablePrintCount++;
                            echo '<div class="col-xs-12 color-guid p-0">
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
                    </div>';
                        }
                    }
                    ?>
                    <div class="col-xs-12 result-table p-0">
                        <?php
                        $areaItemsTemp = $areaItemsChunk[$loop];
                        $personResultTemp = $personResultChunk[$loop];
                        $ResultTemp = $ResultChunk[$loop];
                        ?>
                        <table style="margin: 0;">
                            <tr>
                                <?php if (!$moalefePrinted) {
                                    $moalefePrinted = !$moalefePrinted; ?>
                                    <td class="fit text-center" colspan="2">#</td>
                                    <?php foreach ($areaItemsTemp as $temp) { ?>
                                        <td class="fit text-center"><?php echo $temp['FATTitle']; ?></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="fit text-center" rowspan="2"><?php echo $area['AreaTitle']; ?></td>
                                <td class="fit text-center">نمره فرد</td>
                                <?php $hasScore=false; foreach ($personResultTemp as $temp) { if(round($temp['FATScore']) > 0){ $hasScore = true;  }  ?>
                                    <td class="fit text-center <?php echo pipExamResultLevel($temp['FATScore']); ?>"><?php echo round($temp['FATScore'], 2); ?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="fit text-center">میانگین سازمان</td>
                                <?php foreach ($ResultTemp as $temp) { ?>
                                    <td class="fit text-center   <?php echo pipExamResultLevel($temp['AVG']); ?>"><?php echo round($temp['AVG'], 2); ?></td>
                                <?php } ?>
                            </tr>
                            <tr class="<?php  if($hasScore) echo 'true'; else echo 'false'; ?>"></tr>
                        </table>
                    </div>
                </div>
                <?php
                if ($area['BreakTable'] == 1) {
                    $tanasobHasTableBreak = true;
                }
                ?>
            <?php } ?>
        <?php }
    }
} ?>


<?php if ($tanasobHasTableBreak) {
    echo '<div class="break"></div>';
} ?>

<?php
foreach ($TotalResult as $item) {
    if ($item['area']['Tanasob'] == 1) {
        if (!empty($item['personResult'])) {
            $hasScore = false;
            foreach ($item['personResult'] as $chunk) {
                if ($chunk['FATScore'] != null) {
                    $hasScore = true;
                }
            }
            $area = $item['area'];
            $TableCount = $item['TableCount'];
            $areaItemsChunk = $item['areaItemsChunk'];
            $personResultChunk = $item['personResultChunk'];
            $ResultChunk = $item['ResultChunk'];
            if ($hasScore) {
                ?>
                <div class="section d-block">
                    <div class="col-xs-12 area-chart p-0" style="border: 3px dashed #ccc;margin: 15px 0;">
                        <h3 class="area-title"
                            style="text-align: center;margin: 25px;"><?php echo $area['AreaTitle']; ?></h3>
                        <div class="col-xs-12 result-chart" style="height: 320px;width: 100% !important;">
                            <canvas id="ReghbatMinMaxAvgChart-<?php echo $item['uuid']; ?>"
                                    style="height: 320px;width: 100% !important;"></canvas>
                        </div>
                    </div>
                </div>
                <?php if ($area['BreakChart'] == 1) { ?>
                    <div class="break"></div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php }
} ?>