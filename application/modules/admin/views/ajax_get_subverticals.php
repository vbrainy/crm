<?php
foreach($subverticals as $subvertical)
{
    ?>
    <option value="<?php echo $subvertical->id; ?>"><?php echo $subvertical->subvertical_name; ?></option>
    <?php }
?> 