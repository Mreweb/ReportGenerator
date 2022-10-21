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
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($orderModel['ModelId']); ?>
                                       id="inputModelId" name="inputModelId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputModelTitle">عنوان مدل</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   disabled
                                                <?php setInputValue($orderModel['ModelTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputModelTitle" name="inputModelTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>افزودن نمره ( نمرات را به ترتیب از کم به زیاد وارد کنید )</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOptionTitle">عنوان کیفی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputOptionTitle" name="inputOptionTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOptionValue">مقدار کمی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputOptionValue" name="inputOptionValue"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="addModelOption" type="button" class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>  نمرات مدل <?php echo $orderModel['ModelTitle']; ?></legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="fit">ردیف</th>
                                        <th>عنوان کیفی</th>
                                        <th class="fit">مقدار کمی</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $index = 0;
                                    foreach ($orderModelOptions as $item) { ?>
                                        <tr>
                                            <td class="fit"><?php echo ++$index ?></td>
                                            <td><?php echo $item['OptionTitle']; ?></td>
                                            <td class="fit"><?php echo $item['OptionValue']; ?></td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/scoreTableEdit/' . $item['OptionId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove" data-id="<?php echo $item['OptionId']; ?>"
                                                               data-title="<?php echo $item['OptionTitle']; ?>">
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