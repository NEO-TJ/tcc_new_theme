<!-- Uploaded Image -->
<?php if(isset($dsImage)) { ?>
	<table width="100%" cellpadding="1" cellspacing="0">
		<tr>
			<?php $this->load->model('dataclass/eventImage_d'); ?>
			<?php $i=1; ?>
			<?php foreach($dsImage as $image) { ?>
				<td>
					<div class='content-img'>
						<a title="" rel="prettyPhoto[pp_gal]"
						href="<?=base_url().'uploads/Event_Images/'.$image[$this->eventImage_d->colImageUrl] ?>" >
							<img src="<?=base_url().'uploads/Event_Images/thumbs/'.$image[$this->eventImage_d->colImageUrl] ?>" 
								id="<?php echo('img_'.$image[$this->eventImage_d->colId]); ?>" alt="<?=$image[$this->eventImage_d->colCaption]?>">
						</a>
						<span id="<?php echo('delete_'.$image[$this->eventImage_d->colId]); ?>">Delete</span>
					</div>
				</td>
				<?php if($i > 5) { ?>
		</tr>
		<tr>
					<?php $i = 0; ?>
				<?php } ?>
				<?php $i++; ?>
			<?php }?>
		</tr>
	</table>
<?php } ?>
<!-- End Uploaded Image -->