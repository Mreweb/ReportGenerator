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
                                    <?php  setInputValue($order['OrderId']); ?>
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
                                    <?php setInputValue($orderPlan['OrderPlanId']); ?>
                                       id="inputOrderPlanId" name="inputOrderPlanId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderPlanTitle">عنوان برنامه</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                <?php setInputValue($orderPlan['OrderPlanTitle']); ?>
                                                    type="text" class="form-control" id="inputOrderPlanTitle"
                                                   name="inputOrderPlanTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputModelTitle">مکان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="inputOrderPlanPlace"
                                                <?php setInputValue($orderPlan['OrderPlanPlace']); ?>
                                                   name="inputOrderPlanPlace"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputStartDate">تاریخ شروع</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date-picker" id="inputStartDate"
                                                <?php setInputValue($orderPlan['StartDate']); ?>
                                                   name="inputStartDate"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputEndDate">تاریخ پایان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date-picker" id="inputEndDate"
                                                <?php setInputValue($orderPlan['EndDate']); ?>
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
                                                    <option
                                                            <?php setOptionSelected($planManager['PlanManagerId'] , $orderPlan['PlanManagerId']); ?>
                                                            value="<?php echo $planManager['PlanManagerId']; ?>">
                                                        <?php echo $planManager['PersonFirstName'] . " " . $planManager['PersonLastName']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="editOrderPlan" type="button"
                                            class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>