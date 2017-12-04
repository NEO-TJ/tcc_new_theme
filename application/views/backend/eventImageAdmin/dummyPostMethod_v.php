<!DOCTYPE html>
<html>
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="keywords" content="ผู้ใช้งาน" />
		<meta name="description" content="ผู้ใช้งาน">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
	</head>

	<body>
		<?php echo form_open(base_url("eventImageAdmin"), array("id" => "formRedirectPostMethod")); ?>
		<input type="hidden" name="iccCardId" value="<?php echo $iccCardId ?>" />
		<?php echo form_close(); ?><!-- Close form redirect post method -->

		<script>
			window.onload = function() {
				document.forms['formRedirectPostMethod'].submit();
			}
		</script>
	</body>
</html>