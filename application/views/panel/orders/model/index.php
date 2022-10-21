<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend> مشخصات مدل برای سفارش <?php echo $order['OrderTitle']; ?></legend>
                                <input type="hidden" class="form-control"
                                       <?php  setInputValue($order['OrderId']); ?>
                                       maxlength="80" minlength="3"
                                       id="inputOrderId" name="inputOrderId"/>
                                <input type="hidden" class="form-control"
                                        <?php  if(!empty($orderModel)){ setInputValue($orderModel['ModelId']); } ?>
                                       maxlength="80" minlength="3"
                                       id="inputModelId" name="inputModelId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputModelTitle">عنوان مدل</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php if(!empty($orderModel)){ setInputValue($orderModel['ModelTitle']); } ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputModelTitle" name="inputModelTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-xs-12 p-0">
                                <button type="button" id="editOrder" class="btn btn-primary waves-effect">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>