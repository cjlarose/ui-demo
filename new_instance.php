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
instanceSizes = [
	{name: 'm1.small', cpu: 2, mem: 4096, disk: 10},
	{name: 'c1.medium', cpu: 4, mem: 8092, disk: 20},
	{name: 'm1.large', cpu: 4, mem: 16384, disk: 30},
	{name: 'm1.xlarge', cpu: 8, mem: 24576, disk: 40},
	{name: 'c1.xlarge', cpu: 16, mem: 32768, disk: 50}
];

function updateSizeDisplay(i) {
	instance = instanceSizes[i];
	$('#size-info dd:eq(0)').text(instance.name);
	$('#size-info dd:eq(1)').text(instance.cpu);
	$('#size-info dd:eq(2)').text(instance.mem + " MB");
	$('#size-info dd:eq(3)').text(instance.disk + " GB");
}

$(function() {
	updateSizeDisplay(0);
	$('#instance-size-slider').slider({
		range: 'min',
		value: 0,
		min: 0,
		max: 4,
		step: 1,
		slide: function(event, ui) {
			updateSizeDisplay(ui.value);	
		}
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
			<dl id="size-info">
				<dt>Identifier:</dt>
				<dd></dd>
				<dt>CPU:</dt>
				<dd></dd>
				<dt>Memory:</dt>
				<dd></dd>
				<dt>Disk Space:</dt>
				<dd></dd>
			</dl>
			<div id="instance-size-slider"></div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<textarea class="input-xlarge" id="description"></textarea>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Launch Instance</button>
	</div>
</form>

<?php include 'footer.php'; ?>
