<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">افزودن ارزیاب</a></li>
                                <li role="presentation"><a href="#profile" data-toggle="tab">ارزیاب های تخصیص داده شده</a></li>
                                <li role="presentation"><a target="_blank" class="btn btn-default" style="    background: #1f91f3 !important;color: #fff !important;font-size: 15px;padding: 8px 20px !important; position: relative;top: 12px;" href="<?php echo base_url('Panel/FoundationValuer/add'); ?>">تعریف ارزیاب جدید</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
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
                                                           <?php  setInputValue($order['OrderTitle']); ?>
                                                           maxlength="80" minlength="3"
                                                           id="inputOrderTitle" name="inputOrderTitle"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-xs-12">
                                        <legend>انتخاب ارزیاب</legend>
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>نام و نام خانوادگی</th>
                                                    <th class="fit">تلفن</th>
                                                    <th class="fit">موسسه ارزیابی</th>
                                                    <th class="fit">افزودن</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-rows">
                                                <?php foreach ($valuers as $item) { ?>
                                                    <tr>
                                                        <td><?php echo $item['PersonFirstName']." ".$item['PersonLastName']; ?></td>
                                                        <td class="fit"><?php echo $item['PersonPhone']; ?></td>
                                                        <td class="fit"><?php echo $item['FoundationTitle']; ?></td>
                                                        <td class="fit">
                                                            <button data-person-id="<?php echo $item['ValuerId']; ?>" type="button" class="btn btn-primary add-to-order">
                                                                افزودن به سفارش
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th class="fit">نام و نام خانوادگی</th>
                                                <th class="fit">تلفن</th>
                                                <th> تغییر ارزیاب</th>
                                                <th class="fit">حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-rows">
                                            <?php foreach ($orderValuer as $item) { ?>
                                                <tr>
                                                    <td class="fit"><?php echo $item['PersonFirstName']." ".$item['PersonLastName']; ?></td>
                                                    <td class="fit"><?php echo $item['PersonPhone']; ?></td>
                                                    <td>
                                                        <select class="form-control" style="width: 350px;float: right">
                                                            <?php foreach ($valuers as $v) { ?>
                                                                <option value="<?php echo $v['ValuerId']; ?>">
                                                                    <?php echo $v['PersonFirstName']." ".$v['PersonLastName']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <button data-id="<?php echo $item['RowId']; ?>"  type="button" class="btn btn-success edit-from-order">
                                                            تغییر ارزیاب
                                                        </button>
                                                    </td>
                                                    <td class="fit">
                                                        <button data-title="<?php echo $item['PersonFirstName']." ".$item['PersonLastName']; ?>" data-id="<?php echo $item['RowId']; ?>" type="button" class="btn btn-danger delete-from-order">
                                                            حذف از سفارش
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>