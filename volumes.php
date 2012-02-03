<?php
$volume_data = array(
	array('Volume 1', 'This volume does all kinds of things', '10'),
	array('Cool Volume', 'This volume does super super cool things, I promise!', '12'),
	array('Super super cool volume', 'This volume does cooler things than both volume 1 and volume 2 combined', '15')
);
$volumes = array();
foreach ($volume_data as $volume_datum) {
	$volumes[] = (object) array(
		'name' => $volume_datum[0],
		'description' => $volume_datum[1],
		'size' => $volume_datum[2]
	);	
}

$instance_data = array(
	array('i-46190768', 'Image 1', 'm1.small'),
	array('i-3A38061E', 'Image 2', 'c1.medium'),
	array('i-46190768', 'Image 3', 'c1.xlarge')
);

$instances = array();
foreach ($instance_data as $instance_datum) {
	$instances[] = (object) array(
		'name' => 'iPlant Base Image',
		'id' => $instance_datum[0],
		'description' => $instance_datum[1],
		'size' => $instance_datum[2]
	);
}
?>
<?php include 'header.php'; ?>

<script type="text/javascript">
$(function() {
	$('#vols-list li')
		.addClass('unattached')
		.draggable({revert: 'invalid'});
	$('#vols-instances-list li').droppable({
		hoverClass: 'droppable-highlight',
		accept: '.unattached',
		drop: function(event, ui) {
			$("<li></li>")
				.html(ui.draggable.html())
				.appendTo($(this).find('ul'))
				.append('<a class="close">&times;</a>')
				.find('a.close')
				.click(function(e) {
					e.preventDefault();
					$('<li></li>')
						.html($(this).parent().html())
						.appendTo('#vols-list')
						.addClass('unattached')
						.draggable({revert: 'invalid'})
						.find('a.close')
						.remove();
					$(this).parent().remove();
					return false;
				});
			$(ui.draggable).remove();
		}
	});
});
</script>

<h1>Volume Management</h1>
<p>To attach a volume, drag it from the column on the left onto an instance on the right.</p>
<div id="vols-container">
	<div id="vols-volumes">
		<h2>Existing Volumes</h2>
		<ul id="vols-list">
<?php
foreach ($volumes as $volume) {
	echo "\t\t\t<li><h3>{$volume->name} ({$volume->size} GB)</h3><p>{$volume->description}</p></li>\n";	
}
?>
		</ul>
	</div>
	<div id="vols-instances">
		<h2>Running instances</h2>
		<ul id="vols-instances-list">
<?php
foreach ($instances as $instance) {
	echo "\t\t\t<li>
				<h3>{$instance->name} ({$instance->id})</h3>
				<p>{$instance->description}</p>
				<ul class=\"attached-volumes-list\"></ul>	
			</li>\n";
}
?>
		</ul>
		<a href="#" class="btn btn-primary">Apply Changes</a>
	</div>
</div>
<?php
?>

<?php include 'footer.php'; ?>
