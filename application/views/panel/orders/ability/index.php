<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12 info">
                                <legend>مشخصات مدل</legend>
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($order['IsAbilityBase']); ?>
                                       id="inputIsAbilityBase" name="inputIsAbilityBase"/>
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
                                <legend>افزودن شایستگی</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAbilityTitle">عنوان شایستگی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputAbilityTitle" name="inputAbilityTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputLow">کمترین نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputLow" name="inputLow"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputHigh">بیشترین نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputHigh" name="inputHigh"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputMin">حداقل نمره قابل قبول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputMin" name="inputMin"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputLowEditRange">حداقل بازه تغییر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control text-center ltr"
                                                <?php setInputValue($Enum['AbilityEditRange']['Low']); ?>
                                                   id="inputLowEditRange" name="inputLowEditRange"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputHighEditRange">حداکثر بازه تغییر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control text-center ltr"
                                                <?php setInputValue($Enum['AbilityEditRange']['High']); ?>
                                                   min="0"
                                                   id="inputHighEditRange" name="inputHighEditRange"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputRandType">نحوه رند نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputRandType" name="inputRandType">
                                                <?php foreach ($Enum['RondType'] as $key => $value) { ?>
                                                    <option value="<?php echo $key; ?>">
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="addAbility" type="button"
                                            class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend> شایستگی های مدل <?php echo $orderModel['ModelTitle']; ?></legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان شایستگی</th>
                                        <th class="fit">کمترین نمره</th>
                                        <th class="fit">بیشترین نمره</th>
                                        <th class="fit">حداقل نمره</th>
                                        <th class="fit">نوع رند کردن</th>
                                        <th class="fit">حداقل بازه تغییر</th>
                                        <th class="fit">حداکثر بازه تغییر</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody  class="sortable">
                                    <?php foreach ($orderModelAbility as $item) { ?>
                                        <tr class="ability-row" data-ability-id="<?php echo $item['AbilityId']; ?>" style="cursor: move">
                                            <td><?php echo $item['AbilityTitle']; ?></td>
                                            <td class="fit"><?php echo $item['Low']; ?></td>
                                            <td class="fit"><?php echo $item['High']; ?></td>
                                            <td class="fit"><?php echo $item['Min']; ?></td>
                                            <td class="fit"><?php echo pipeEnum('RondType', $item['RandType']); ?></td>
                                            <td class="fit"><?php echo $item['LowEditRange']; ?></td>
                                            <td class="fit"><?php echo $item['HighEditRange']; ?></td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if ($order['IsAbilityBase'] == 0) { ?>
                                                            <li>
                                                                <a href="<?php echo base_url('Panel/Orders/markers/' . $item['AbilityId']); ?>">نشانگرها</a>
                                                            </li>
                                                        <?php } ?>
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/abilityEdit/' . $item['AbilityId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove"
                                                               data-id="<?php echo $item['AbilityId']; ?>"
                                                               data-title="<?php echo $item['AbilityTitle']; ?>">
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
    </div>
</section>