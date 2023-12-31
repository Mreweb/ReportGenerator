<span class="btn btn-info table-row-count"><?php echo $count; ?></span>
<?php
if ((isset($data) && !$data) || $data == NULL) { ?>
    <tr class="warning">
        <td colspan="12">موردی یافت نشد</td>
    </tr>
<?php } else {
    $counter = $startPage + 1;
    foreach ($data as $item) { ?>
        <tr>
            <td class="fit"><?php echo $item['OrderId']; ?></td>
            <td><?php echo $item['OrderTitle']; ?></td>
            <td class="fit"><?php echo $item['FoundationTitle']; ?></td>
            <td class="fit"><?php echo pipeStatus($item['orderIsActive']); ?></td>
            <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
            <td class="fit">
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        عملیات <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('Panel/Orders/persons/') . $item['OrderId']; ?>">فهرست افراد</a></li>
                            <li><a href="<?php echo base_url('Panel/Orders/area/') . $item['OrderId']; ?>">تعریف حوزه ارزیابی</a></li>
                            <li><a href="<?php echo base_url('Panel/Orders/edit/') . $item['OrderId']; ?>">ویرایش دوره</a></li>
                            <li><a href="<?php echo base_url('Panel/Orders/download/') . $item['OrderId']; ?>">دانلود خروجی اکسل </a></li>
                            <li><a target="_blank" class="remove" data-id="<?php echo $item['OrderId']; ?>" data-title="<?php echo $item['OrderTitle']; ?>">حذف دوره</a></li>
                    </ul>
                </div>
                <?php }  ?>
            </td>
        </tr>
    <?php } ?>