<?php
print_r($images);
?>
<?php foreach (array_chunk($images, 4) as $image) { ?>
<div class="row">
  <?php foreach ($image as $image) { ?>
  <div class="col-sm-3 text-center">
    <?php print_r($image) ?>
  </div>
  <?php } ?>
</div>
<br />
<?php } ?>