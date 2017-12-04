<!-- Table body -->
	<?php 
	$numRecordStart++;
	foreach($dsIccCardList as $row) {
	?>
		<tr>
			<td class="text-center"><?php echo $numRecordStart++ ?></td>
			<td class="text-left">
				<a title="ดูอัลบัมภาพ" href="<?php echo(base_url('eventImageGallery/gallery/' . $row['id'])) ?>">
					<?php echo $row['ชื่อโครงการ'] ?>
				</a>
			</td>
			<td class="text-left"><?php echo $row['วันที่ทำกิจกรรม'] ?></td>
			<td class="text-left"><?php echo $row['อำเภอ'] ?></td>
			<td class="text-left"><?php echo $row['จังหวัด'] ?></td>
		</tr>
	<?php } ?>
<!-- End Table body -->
