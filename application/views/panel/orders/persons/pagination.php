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
            <td><?php echo $item['FirstName']." ".$item['LastName']; ?></td>
            <td class="fit"><?php echo $item['NationalCode']; ?></td>
            <td class="fit"><?php echo pipeStatus($item['Tag']); ?></td>
            <td class="fit">
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        عملیات <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('Panel/Orders/reportFull/') . $item['NationalCode'].'/'.$item['OrderId']; ?>">مشاهده نتایج</a></li>
                    </ul>
                </div>
                <?php }  ?>
            </td>
        </tr>
    <?php } ?>