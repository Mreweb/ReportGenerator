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
                                                   id="inputOrderlTitle" name="inputOrderTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>مشخصات ارزیابی شونده</legend>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonFirstName">نام</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonFirstName" name="inputPersonFirstName"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonLastName">نام خانوادگی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonLastName" name="inputPersonLastName"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label for="inputPersonNationalCode">کد ملی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonNationalCode" name="inputPersonNationalCode"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label for="inputPersonCode">شناسه سازمانی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonCode" name="inputPersonCode"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label for="inputPersonPhone">تلفن</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonPhone" name="inputPersonPhone"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                <button type="button" id="addOrderPerson"
                                        class="btn btn-success waves-effect pull-left">
                                    ذخیره
                                </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">

                                <legend>
                                    فهرست ارزیابی شوندگان سفارش
                                    <?php echo $order['OrderTitle']; ?>
                                    (<?php echo sizeof($orderPerson); ?> نفر )

                                </legend>
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover sticky">
                                        <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th class="fit">نام خانوادگی</th>
                                            <th class="fit">کد ملی</th>
                                            <th class="fit">شناسه سازمانی</th>
                                            <th class="fit">تلفن</th>
                                            <th class="fit">تاریخ ثیت</th>
                                            <th class="fit">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-rows">
                                        <?php foreach ($orderPerson as $item) { ?>
                                            <tr>
                                                <td class="edit" contenteditable="true" data-info-type="PersonFirstName"
                                                    data-person-id="<?php echo $item['PersonId']; ?>"><?php echo $item['PersonFirstName']; ?></td>
                                                <td class="fit edit" contenteditable="true"
                                                    data-info-type="PersonLastName"
                                                    data-person-id="<?php echo $item['PersonId']; ?>"><?php echo $item['PersonLastName']; ?></td>
                                                <td class="fit edit" contenteditable="true"
                                                    data-info-type="PersonNationalCode"
                                                    data-person-id="<?php echo $item['PersonId']; ?>"><?php echo $item['PersonNationalCode']; ?></td>
                                                <td class="fit edit" contenteditable="true" data-info-type="PersonCode"
                                                    data-person-id="<?php echo $item['PersonId']; ?>"><?php echo $item['PersonCode']; ?></td>
                                                <td class="fit edit" contenteditable="true" data-info-type="PersonPhone"
                                                    data-person-id="<?php echo $item['PersonId']; ?>"><?php echo $item['PersonPhone']; ?></td>
                                                <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
                                                <td class="fit">
                                                    <div class="btn-group">
                                                        <a class="remove"
                                                           data-id="<?php echo $item['RowId']; ?>"
                                                           data-title="<?php echo $item['PersonFirstName'] . " " . $item['PersonLastName']; ?>">
                                                            <button type="button" class="btn btn-danger">
                                                                حذف
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>