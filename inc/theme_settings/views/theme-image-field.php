<div class="ad">

  <small><?php echo $desc ?></small>
  <br><br>

  <div class="selected-image <?php echo $hidden ?>">
    <img src="<?php echo $url ?>">
  </div>
  <input class="upload_image_button button upload_image" type="button" value="Vælg billede">
  &nbsp;&nbsp;<a href="#" class="button  <?php echo $hidden ?> remove-selected">Fjern billede</a>
  <input type="hidden" class="bannerad_url" name="<?php echo $field ?>" value="<?php echo $url ?>">
  <br><br>
  <input type="text" class="regular-text" name="<?php echo $field . CS_ADS_LINK_EXTENSION ?>" value="<?php echo $link ?>"><br>
  <small>Url / link (format: http://example.com eller www.example.com)</small>
</div>