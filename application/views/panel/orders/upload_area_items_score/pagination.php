<span class="btn btn-info table-row-count"><?php echo $count; ?></span>
<?php
if ((isset($data) && !$data) || $data == NULL) { ?>
    <tr class="warning">
        <td colspan="12">موردی یافت نشد</td>
    </tr>
<?php } else {
    $counter = 0;
    $startPage += 1;
    for ( $i=0; $i <$count; $i+=$itemCount ) { ?>
        <tr>
            <td class="fit"><?php echo $data[$i]['FirstName']; ?></td>
            <td class="fit"><?php echo $data[$i]['LastName']; ?></td>
            <td class="fit"><?php echo $data[$i]['NationalCode']; ?></td>
            <?php for ($j=0;$j<$itemCount;$j++) { ?>
                <td class="fit"><?php echo $data[$i+$j]['FATScore']; ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
<?php } ?>