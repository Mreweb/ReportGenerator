<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                                <input  <?php setInputValue($customer['CustomerId']); ?>
                                        type="hidden"
                                        name="inputCustomerId" id="inputCustomerId"/>
                            <fieldset class="col-xs-12 info">
                                <legend>اطلاعات مشتری</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCustomerTitle">عنوان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                  <?php setInputValue($customer['CustomerTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputCustomerTitle" name="inputCustomerTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCustomerAddress">آدرس</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php setInputValue($customer['CustomerAddress']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputCustomerAddress" name="inputCustomerAddress"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputDescriptionFile">فایل توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control"
                                                   id="inputDescriptionFile" name="inputDescriptionFile"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label for="inputDescription">توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php setInputValue($customer['Description']); ?>

                                                   id="inputDescription" name="inputDescription"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="col-xs-12">
                                <legend>فایل های مشتری</legend>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th class="fit">دانلود</th>
                                            <th class="fit">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 0; foreach ($customerFiles as $customerFile) { ?>
                                            <tr>
                                                <td><?php echo ++$index; ?></td>
                                                <td class="fit">
                                                    <a class="down-btn" href="<?php echo $customerFile['File']; ?>">

                                                        <button class="btn btn-success">
                                                            دانلود
                                                        </button>
                                                    </a>
                                                </td>
                                                <td class="fit">
                                                    <button
                                                            data-title="فایل"
                                                            data-id="<?php echo $customerFile['RowId']; ?>"
                                                            class="btn btn-danger remove">
                                                        حذف
                                                    </button>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </fieldset>

                            <div class="col-xs-12 p-0">
                                <button type="button" id="editCustomer" class="btn btn-success waves-effect pull-left">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

