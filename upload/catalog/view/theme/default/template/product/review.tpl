<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<table class="table table-striped table-bordered">
  <tr>
    <td style="width: 50%;"><strong><?php echo $review['author']; ?></strong></td>
    <td class="text-right"><?php echo $review['date_added']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><p><?php echo $review['text']; ?></p>
      <?php for ($i = 1; $i <= 5; $i++) { ?>
      <?php if ($review['rating'] < $i) { ?>
      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
      <?php } else { ?>
      <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
      <?php } ?>
      <?php } ?></td>
  </tr>


  <?php if (count($review['images'])) { ?>
  <tr valign="middle">
    <td colspan="2">
      <ul class="thumbnails thumbnails-revs">
        <?php $image_row = 0; ?>
        <?php foreach ($review['images'] as $image) { ?>
          <li class="image-additional">
            <a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $image['popup'];  ?>"> 
              <img src="<?php echo $image['thumb']; ?>" title="<?php echo $image['thumb']; ?>" alt="<?php echo $image['thumb']; ?>" />
            </a></li>
          <?php $image_row++; ?>
        <?php } ?>
      </ul>
  </td>
  </tr>
  <?php } ?>

</table>
<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_no_reviews; ?></p>
<?php } ?>

<script>
  $(document).ready(function() {
	$('.thumbnails-revs').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:false
		}
	});
});
</script>
