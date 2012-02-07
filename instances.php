<?php include 'header.php'; ?>
<?php
$instance_data = array(
	array('i-46190768', 'Image 1', 'emi-2F2B2523', 'New Base Image', '128.196.142.26', '', 'running', 1328630258, 'm1.small'),
	array('i-3A38061E', 'Image 2', 'emi-2F2B2523', 'New Base Image', '128.196.142.68', '', 'running', 1328630258, 'm1.small'),
	array('i-46190768', 'Image 3', 'emi-2F2B2523', 'New Base Image', '128.196.142.29', '', 'running', 1328630258, 'm1.small')
);

$instances = array();
foreach ($instance_data as $instance_datum) {
	$instances[] = (object) array(
		'name' => 'iPlant Base Image',
		'id' => $instance_datum[0],
		'description' => $instance_datum[1],
		'image' => $instance_datum[2],
		'image_name' => $instance_datum[3],
		'address' => $instance_datum[4],
		'key_name' => $instance_datum[5],
		'state' => $instance_datum[6],
		'launch_time' => $instance_datum[7],
		'size' => $instance_datum[8]
	);
}
?>
<h1>Instances</h1>
<a id="new-instance-link" class="btn btn-primary" href="new_instance.php">New Instance</a>
<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Instance ID</th>
			<th>Machine Image</th>
			<th>Public DNS Name</th>
			<th>Key Name</th>
			<th>State</th>
			<th>Machine Size</th>
			<th>Launch Time</th>
		</tr>
	</thead>
	<tbody>
<?php 
foreach ($instances as $instance) {
	echo "<tr>";
	$cells = array(
		$instance->name,
		$instance->description,
		$instance->id,
		$instance->image_name . " (" . $instance->image . ")",
		$instance->address,
		$instance->key_name,
		$instance->state,
		$instance->size,
		$instance->launch_time
	);
	foreach ($cells as $cell) 
		echo "<td>{$cell}</td>";
	echo "</tr>";
}
?>
	</tbody>
</table>
<?php include 'footer.php'; ?>
