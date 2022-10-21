<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12 info">
                                <legend>مشخصات سفارش</legend>
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($order['OrderId']); ?>
                                       id="inputOrderId" name="inputOrderId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderTitle">عنوان سفارش</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   disabled
                                                <?php setInputValue($order['OrderTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputOrderTitle" name="inputOrderTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>مشخصات برنامه</legend>
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($order['OrderId']); ?>
                                       id="inputOrderId" name="inputOrderId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderPlanTitle">عنوان برنامه</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="inputOrderPlanTitle"
                                                   name="inputOrderPlanTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputModelTitle">مکان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="inputOrderPlanPlace"
                                                   name="inputOrderPlanPlace"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputStartDate">تاریخ شروع</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date-picker" id="inputStartDate"
                                                   name="inputStartDate"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputEndDate">تاریخ پایان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date-picker" id="inputEndDate"
                                                   name="inputEndDate"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label class="required" for="inputPlanManagerId">مدیر برنامه</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputPlanManagerId">
                                                <?php foreach ($planManagers as $planManager) { ?>
                                                    <option value="<?php echo $planManager['PlanManagerId']; ?>">
                                                        <?php echo $planManager['PersonFirstName'] . " " . $planManager['PersonLastName']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="addOrderPlan" type="button"
                                            class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>فهرست برنامه ها</legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان برنامه</th>
                                        <th class="fit">مکان</th>
                                        <th class="fit">تاریخ شروع</th>
                                        <th class="fit">تاریخ پایان</th>
                                        <th class="fit">مدیر برنامه</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orderPlans as $item) { ?>
                                        <tr>
                                            <td><?php echo $item['OrderPlanTitle']; ?></td>
                                            <td class="fit"><?php echo $item['OrderPlanPlace']; ?></td>
                                            <td class="fit"><?php echo $item['StartDate']; ?></td>
                                            <td class="fit"><?php echo $item['EndDate']; ?></td>
                                            <td class="fit">
                                                <?php
                                                foreach ($planManagers as $planManager) {
                                                    if ($planManager['PlanManagerId'] == $item['PlanManagerId']) {
                                                        echo $planManager['PersonFirstName'] . " " . $planManager['PersonLastName'];
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="hidden">
                                                            <a href="<?php echo base_url('Panel/Orders/planTable/' . $item['OrderPlanId']); ?>">ساخت
                                                                جدول زمانی</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/planTableRecords/' . $item['OrderPlanId']); ?>">تکمیل
                                                                جدول زمانی</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/planEdit/' . $item['OrderPlanId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove"
                                                               data-id="<?php echo $item['OrderPlanId']; ?>"
                                                               data-title="<?php echo $item['OrderPlanTitle']; ?>">
                                                                حذف
                                                            </a>
                                                        </li>
                                                    </ul>
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
</section>