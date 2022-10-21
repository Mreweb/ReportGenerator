<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">

                        <div class="col-xs-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">
                                        جدول افراد
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                        میانگین تمامی شایستگی ها
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                        میانگین شایستگی ها
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                                        نمودار تفکیکی شایستگی-افراد
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                                        جدول تفکیکی
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="tab1">
                                    <!-- Person -->
                                    <div class="col-xs-12">
                                        <div class="table-responsive" style="overflow-x: scroll;">
                                            <button class="btn btn-primary" id="export"
                                                    style="float: left;margin-bottom: 15px;">خروجی اکسل
                                            </button>
                                            <table id="table2excel"
                                                   class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                <tr>
                                                    <td class="text-center">نام</td>
                                                    <td class="text-center">نام خانوداگی</td>
                                                    <td class="text-center">کد ملی</td>
                                                    <td class="text-center">تلفن</td>
                                                    <?php foreach ($orderModelAbility as $item) { ?>
                                                        <td class="text-center"><?php echo $item['AbilityTitle']; ?></td>
                                                    <?php } ?>
                                                    <td class="text-center">امتیاز کل</td>
                                                    <?php foreach ($orderPerson[0]['Tools'] as $key => $value) { ?>
                                                        <td class="text-center"><?php echo $key; ?></td>
                                                    <?php } ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $index = -1;
                                                foreach ($orderPerson as $op) {
                                                    $index += 1;
                                                    $avgAll = array(); ?>
                                                    <tr>
                                                        <td class="text-center"><b
                                                                    class="score"><?php echo $op['PersonFirstName']; ?></b>
                                                        </td>
                                                        <td class="text-center"><b
                                                                    class="score"><?php echo $op['PersonLastName']; ?></b>
                                                        </td>
                                                        <td class="text-center"><b
                                                                    class="score"><?php echo $op['PersonNationalCode']; ?></b>
                                                        </td>
                                                        <td class="text-center"><b
                                                                    class="score"><?php echo $op['PersonPhone']; ?></b>
                                                        </td>
                                                        <?php foreach ($orderModelAbility as $item) {
                                                            $avg = array(); ?>
                                                            <td class="text-center">
                                                                <?php
                                                                foreach ($op['score'] as $sc) {
                                                                    if ($sc['AbilityId'] == $item['AbilityId']) {
                                                                        if ($sc['PlanManagerAVGScore'] > 0) {
                                                                            array_push($avg, $sc['PlanManagerAVGScore']);
                                                                        }
                                                                    }
                                                                }
                                                                $temp = round(array_sum($avg) / sizeof($avg));
                                                                if (is_nan($temp)) {
                                                                    echo '<b class="score">-</b>';
                                                                } else {
                                                                    if ($temp < $item['Min']) {
                                                                        echo '<b class="score">' . $temp . '</b>';
                                                                        echo '<br>';
                                                                        echo '<label class="label label-danger">ضعیف</label>';
                                                                    }
                                                                    if ($temp == $item['Min']) {
                                                                        echo '<b class="score">' . $temp . '</b>';
                                                                        echo '<br>';
                                                                        echo '<label class="label label-info">متوسط</label>';
                                                                    }
                                                                    if ($temp > $item['Min']) {
                                                                        echo '<b class="score">' . $temp . '</b>';
                                                                        echo '<br>';
                                                                        echo '<label class="label label-success">قابل قبول</label>';
                                                                    }
                                                                    array_push($avgAll, $temp);
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php } ?>
                                                        <td class="text-center">
                                                            <?php
                                                            if (is_nan(array_sum($avgAll) / sizeof($avgAll))) {
                                                                $orderPerson[$index]['AVGAllScore'] = 0;
                                                                echo '<b class="score">-</b>';
                                                            } else {
                                                                echo '<b class="score">' . round(array_sum($avgAll) / sizeof($avgAll)) . '</b>';
                                                                $orderPerson[$index]['AVGAllScore'] = round(array_sum($avgAll) / sizeof($avgAll));
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php foreach ($op['Tools'] as $key => $value) { ?>
                                                                <td class="fit">
                                                                    <b class="score"><?php echo $value; ?></b>
                                                                </td>
                                                        <?php }?>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Person -->
                                    <!-- Donugt Chart  -->
                                    <div class="col-md-6 col-xs-12">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>نام و نام خانوادگی</th>
                                                <th class="fit">وضعیت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($orderPerson as $orderPerson) { ?>
                                                <tr>
                                                    <td><?php echo $orderPerson['PersonFirstName'] . " " . $orderPerson['PersonLastName']; ?></td>
                                                    <td class="fit">
                                                        <?php echo ScoreStatus($orderPerson['Accepted']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <canvas id="myChart" height="200"></canvas>
                                    </div>
                                    <!-- End Donugt Chart  -->
                                </div>

                                <div role="tabpanel" class="tab-pane" id="settings">
                                    <?php
                                    foreach ($orderModelAbility as $item) {
                                        $abilityId = $item['AbilityId'];
                                        $upperRange = array();
                                        $middleRange = array();
                                        $lowRange = array();
                                        $lowerRange = array();
                                        foreach ($orderPersons as $op) {
                                            foreach ($op['score'] as $sc) {
                                                if ($sc['AbilityId'] == $item['AbilityId']) {
                                                    if (floatval($sc['PlanManagerAVGScore']) >= floatval(($item['Min'] + (0.2 * $item['Min'])))) {
                                                        array_push($upperRange, $op['PersonId']);
                                                    }
                                                    if ((floatval($sc['PlanManagerAVGScore']) >= floatval($item['Min'])) && (floatval($sc['PlanManagerAVGScore']) < floatval(($item['Min'] + (0.2 * $item['Min']))))) {
                                                        array_push($middleRange, $op['PersonId']);
                                                    }
                                                    if ((floatval($sc['PlanManagerAVGScore']) < floatval($item['Min'])) && (floatval($sc['PlanManagerAVGScore']) >= floatval(($item['Min'] - (0.2 * $item['Min']))))) {
                                                        array_push($lowRange, $op['PersonId']);
                                                    }
                                                    if (floatval($sc['PlanManagerAVGScore']) < floatval(($item['Min'] - (0.2 * $item['Min'])))) {
                                                        array_push($lowerRange, $op['PersonId']);
                                                    }
                                                }
                                            }
                                        }
                                        /*var_dump($upperRange);
                                        var_dump($middleRange);
                                        var_dump($lowRange);
                                        var_dump($lowerRange);*/
                                        $upperRange = array_unique($upperRange);
                                        $middleRange = array_unique($middleRange);
                                        $lowRange = array_unique($lowRange);
                                        $lowerRange = array_unique($lowerRange);

                                        $totalScoreCount = count($upperRange) + count($middleRange) + count($lowRange) + count($lowerRange);
                                        ?>
                                        <div class="col-md-6 col-xs-12">
                                            <table class="table table-bordered table-condensed table-striped">
                                                <thead>
                                                <tr style="background: #127d88;color:#fff;">
                                                    <th style="vertical-align: middle" class="text-center"
                                                        rowspan="2"><?php echo $item['AbilityTitle']; ?></th>
                                                    <th colspan="2">
                                                        <table>
                                                            <tr style="background: #127d88;color:#fff;">
                                                                <th colspan="2" class="text-center">
                                                                    سطح استاندارد =
                                                                    <?php echo $item['Min']; ?>
                                                                </th>
                                                            </tr>
                                                            <tr style="background: #127d88;color:#fff;">
                                                                <th class="text-center">تعداد نفرات</th>
                                                                <th class="text-center">درصد نفرات</th>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="background: green;color:#fff;">
                                                    <td class="text-center">فراتر از استاندارد</td>
                                                    <td class="text-center"><?php echo count($upperRange); ?></td>
                                                    <td class="text-center"><?php echo round((count($upperRange) * 100) / $totalScoreCount, 2); ?></td>
                                                </tr>
                                                <tr style="background: #54a925;color:#fff;">
                                                    <td class="text-center">معادل از استاندارد</td>
                                                    <td class="text-center"><?php echo count($middleRange); ?></td>
                                                    <td class="text-center"><?php echo round((count($middleRange) * 100) / $totalScoreCount, 2); ?></td>
                                                </tr>
                                                <tr style="background: #bb5d0f;color:#fff;">
                                                    <td class="text-center">کمی پایین تر از استاندارد</td>
                                                    <td class="text-center"><?php echo count($lowRange); ?></td>
                                                    <td class="text-center"><?php echo round((count($lowRange) * 100) / $totalScoreCount, 2); ?></td>
                                                </tr>
                                                <tr style="background: #a91212;color:#fff;">
                                                    <td class="text-center">بسیار پایین تر از استاندارد</td>
                                                    <td class="text-center"><?php echo count($lowerRange); ?></td>
                                                    <td class="text-center"><?php echo round((count($lowerRange) * 100) / $totalScoreCount, 2); ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="home">
                                    <div class="col-xs-12" style="height: 400px">
                                        <canvas id="myAllAbilityBarChart"></canvas>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-xs-12">
                                        <canvas id="myRadarChart" style="height: 1200px;"></canvas>
                                    </div>
                                    <div class="col-xs-12">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <?php foreach ($orderModelAbility as $item) { ?>
                                        <div class="col-xs-12 pull-left">
                                            <canvas id="mySingleAbilityBarChart-<?php echo $item['AbilityId']; ?>"></canvas>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>