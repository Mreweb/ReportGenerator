<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>مشخصات سفارش</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderTitle">عنوان سفارش</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputOrderTitle" name="inputOrderTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCustomerId">مشتری</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputCustomerId" id="inputCustomerId">
                                                <?php foreach ($customers as $customer) { ?>
                                                    <option value="<?php echo $customer['CustomerId']; ?>">
                                                        <?php echo $customer['CustomerTitle']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputFoundationId">موسسه ارزیابی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputFoundationId" id="inputFoundationId">
                                                <option value="<?php echo $foundation['FoundationId']; ?>">
                                                    <?php echo $foundation['FoundationTitle']; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputManagerId">مدیر کانون</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputManagerId" id="inputManagerId">
                                                <?php foreach ($managers as $manager) { ?>
                                                    <option value="<?php echo $manager['ManagerId']; ?>">
                                                        <?php echo $manager['PersonFirstName']." ".$manager['PersonLastName']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputIsAbilityBase">نوع سفارش</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputIsAbilityBase" id="inputIsAbilityBase">
                                                <option value="0">نشانگر محور</option>
                                                <option value="1">شایستگی محور</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="button" id="addOrder" class="btn btn-success pull-left waves-effect">ذخیره</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>