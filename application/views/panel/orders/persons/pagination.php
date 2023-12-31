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
            <td class="fit"><?php echo ($item['Tag']); ?></td>
            <td class="fit">
                <a target="_blank" class="btn btn-primary" href="<?php echo base_url('Panel/Orders/reportFull/') . $item['NationalCode'].'/'.$item['OrderId']; ?>">مشاهده نتایج</a>
            </td>

        </tr>
                <?php }  ?>
    <?php } ?>