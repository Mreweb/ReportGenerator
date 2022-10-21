<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#time" data-toggle="tab">
                                        افزودن زمان
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#event" data-toggle="tab">
                                        فهرست زمان ها
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="time">
                                    <fieldset class="col-xs-12">
                                        <legend>مشخصات جدول</legend>
                                        <input type="hidden" class="form-control text-center ltr"
                                               <?php setInputValue($orderPlan['OrderPlanId']); ?>
                                               id="inputOrderPlanId" name="inputOrderPlanId"/>
                                        <div class="col-xs-12 p-0">
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <label class="required" for="inputTimeFrom">از ساعت</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control text-center ltr"
                                                               id="inputTimeFrom" name="inputTimeFrom"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2">
                                                <label class="required" for="inputTimeTo">تا ساعت</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control text-center ltr"
                                                               id="inputTimeTo" name="inputTimeTo"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 p-0">
                                            <button id="addOrderPlanTime" type="button" class="btn btn-primary waves-effect">
                                                ذخیره
                                            </button>
                                        </div>
                                    </fieldset>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="event">
                                    <fieldset class="col-xs-12">
                                        <legend>فهرست زمان ها</legend>
                                        <input type="hidden" class="form-control text-center ltr"
                                            <?php setInputValue($orderPlan['OrderPlanId']); ?>
                                               id="inputOrderPlanId" name="inputOrderPlanId"/>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th class="fit">از ساعت</th>
                                                <th class="fit">تا ساعت</th>
                                                <th class="fit">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-rows">
                                            <?php foreach ($orderPlanTimes as $time) { ?>
                                                <tr>
                                                    <td data-time-type="From" data-time-id="<?php echo $time['TimeId']; ?>" class="fit time-edit" contenteditable="true"><?php echo $time['TimeFrom']; ?></td>
                                                    <td data-time-type="To" data-time-id="<?php echo $time['TimeId']; ?>" class="fit time-edit" contenteditable="true"><?php echo $time['TimeTo']; ?></td>
                                                    <td class="fit">
                                                        <div class="btn-group">
                                                            <button class="remove btn btn-danger"
                                                                    data-id="<?php echo $time['TimeId']; ?>"
                                                                    data-title="<?php echo $time['TimeFrom']." ".$time['TimeTo']; ?>"
                                                                    type="button">حذف</button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="col-xs-12 table-responsive hidden">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>نام و نام خانوادگی</th>
            <th class="fit">کد ملی</th>
            <th class="fit">تلفن</th>
            <th class="fit">عملیات</th>
        </tr>
        </thead>
        <tbody class="table-rows">
        <?php foreach ($orderPerson as $item) { ?>
            <tr>
                <td><?php echo $item['PersonFirstName']." ".$item['PersonLastName']; ?></td>
                <td class="fit"><?php echo $item['PersonNationalCode']; ?></td>
                <td class="fit"><?php echo $item['PersonPhone']; ?></td>
                <td class="fit">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">درج در جدول</button>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
