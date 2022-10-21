<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <fieldset class="col-xs-12">
                            <legend>مشخصات جدول</legend>
                            <input type="hidden" class="form-control text-center ltr"
                                <?php setInputValue($orderPlan['OrderPlanId']); ?>
                                   id="inputOrderPlanId" name="inputOrderPlanId"/>
                            <div class="col-xs-12 p-0">
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputToolId">ابزار</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputToolId">
                                                <option value="0">-- هیچکدام --</option>
                                                <?php foreach ($orderTools as $tool) { ?>
                                                    <option value="<?php echo $tool['ToolId']; ?>">
                                                        <?php echo $tool['ToolTitle']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputValuerId">ارزیاب</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputValuerId">
                                                <option value="0">-- هیچکدام --</option>
                                                <?php foreach ($orderValuer as $valuer) { ?>
                                                    <option value="<?php echo $valuer['ValuerId']; ?>">
                                                        <?php echo $valuer['PersonFirstName'] . "-" . $valuer['PersonLastName']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputPersonIds">ارزیابی شونده</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select data-live-search="true" multiple class="form-control selectpicker"
                                                    id="inputPersonIds">
                                                <option value="All">انتخاب همه</option>
                                                <?php foreach ($orderPerson as $item) { ?>
                                                    <option value="<?php echo $item['PersonId']; ?>">
                                                        <?php echo $item['PersonFirstName'] . " " . $item['PersonLastName']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2 hidden">
                                    <label for="inputRecordTitle">محل</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control text-center ltr"
                                                   value="-"
                                                   id="inputRecordTitle" name="inputRecordTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2 hidden">
                                    <label for="inputTimeId">زمان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputTimeId">
                                                <?php foreach ($orderPlanTimes as $orderPlanTime) { ?>
                                                    <option selected
                                                            value="<?php echo $orderPlanTime['TimeId']; ?>">
                                                        <?php echo $orderPlanTime['TimeFrom'] . "-" . $orderPlanTime['TimeTo']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button id="addOrderPlanTime" type="button"
                                        class="btn btn-success pull-left waves-effect">
                                    ذخیره
                                </button>
                            </div>

                            <ul class="alerts">

                            </ul>

                        </fieldset>
                        <fieldset class="col-xs-12">
                            <legend> فهرست اطلاعات جدول زمانی</legend>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <!--                                                <th>محل</th>-->
                                    <th class="fit">ابزار</th>
                                    <th class="fit">زمان(از ساعت - تا ساعت)</th>
                                    <th class="fit">ارزیاب</th>
                                    <th class="fit"> ارزیابی شونده</th>
                                    <th class="fit">عملیات</th>
                                </tr>
                                </thead>
                                <tbody class="table-rows">
                                <?php
                                foreach ($orderPlanRecords as $item) { ?>
                                    <tr>
                                        <!--                                                    <td>-->
                                        <?php //echo $item['RecordTitle']; ?><!--</td>-->
                                        <td class="fit"><?php echo $item['ToolTitle']; ?></td>
                                        <td class="fit"><?php echo $item['TimeFrom'] . "-" . $item['TimeTo']; ?></td>
                                        <td class="fit"><?php echo $item['PersonFirstName'] . " " . $item['PersonLastName']; ?></td>
                                        <td class="fit">
                                            <table>
                                                <?php
                                                foreach ($item['persons'] as $person) { ?>
                                                    <tr class='bg-info'>
                                                        <td style="padding: 0">
                                                            <b
                                                                data-person-id="<?php echo $person['PersonId']; ?>"
                                                                data-column="PersonFirstName"
                                                                contentEditable="true" class="person-editor"><?php echo $person['PersonFirstName']; ?>
                                                            </b>
                                                        </td>
                                                        <td style="padding: 0">
                                                            <b
                                                                    data-person-id="<?php echo $person['PersonId']; ?>"
                                                                    data-column="PersonLastName"
                                                                    contentEditable="true" class="person-editor"><?php echo $person['PersonLastName']; ?>
                                                            </b>
                                                            <button type="button"
                                                                    class="btn btn-danger btn-sm remove-person pull-left"
                                                                    data-id="<?php echo $item['RecordId']; ?>"
                                                                    data-tool-id="<?php echo $item['ToolId']; ?>"
                                                                    data-valuer-id="<?php echo $item['ValuerId']; ?>"
                                                                    data-person-id="<?php echo $person['PersonId']; ?>"
                                                                    data-title="<?php echo $person['PersonFirstName'] . " " . $person['PersonLastName']; ?>">
                                                                حذف
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
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
                                                    <!--                                                                <li>-->
                                                    <!--                                                                    <a href="-->
                                                    <?php //echo base_url('Panel/Orders/planTableRecordsEdit/' . $item['RecordId']); ?><!--">ویرایش</a>-->
                                                    <!--                                                                </li>-->
                                                    <li>
                                                        <a class="remove"
                                                           data-id="<?php echo $item['RecordId']; ?>"
                                                           data-title="<?php echo $item['RecordTitle']; ?>">
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
</section>

