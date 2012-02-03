<?php
$images = array(
	'image 1',
	'image 2',
	'image 3',
	'image 4',
	'image 5'
);

$select_html = "";
foreach ($images as $image) {
	$select_html .= "<option>{$image}</option>";
}
?><?php include 'header.php'; ?>
<script type="text/javascript">
$(function() {
	$('#instance-size-slider').slider({
		value: 5,
		min: 0,
		max: 5,
		step: 1
	});
});
</script>

<form class="form-horizontal">
<fieldset>
	<legend>Launch New Instance</legend>
	<div class="control-group">
		<label class="control-label" for="instance-name">Instance Name</label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="instance-name" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="image">Image</label>
		<div class="controls">
			<select id="image"><?php echo $select_html; ?></select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="instance-size">Size</label>
		<div class="controls">
			<div id="instance-size-slider"></div>
		</div>
	</div>
</form>

<?php include 'footer.php'; ?>
