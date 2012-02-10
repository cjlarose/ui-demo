<?php
include 'model.php';
$volumes_result = Volume::get_unattached();
$volumes = $volumes_result->results;

$instance_data = array(
	array('i-46190768', 'Image 1', 'm1.small', array(1)),
	array('i-3A38061E', 'Image 2', 'c1.medium'),
	array('i-46190768', 'Image 3', 'c1.xlarge', array(2))
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

$instance_result = Instance::get_all_with_volumes();
$instances = $instance_result->results;
?>
<?php include 'header.php'; ?>

<script type="text/javascript">
$.fn.attachedVolume = function (e) {
$(this)	
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
}
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
				.attachedVolume();
			$(ui.draggable).remove();
		}
	});
	$('.attached-volumes-list > li').attachedVolume();
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
	$attached_volumes_list_content = "";
	foreach ($instance->Volume as $volume)
		$attached_volumes_list_content .= "<li><h3>{$volume->name}</h3><p>{$volume->description}</p></li>";
	echo "\t\t\t<li>
				<h3>{$instance->name} ({$instance->id})</h3>
				<p>{$instance->description}</p>
				<ul class=\"attached-volumes-list\">{$attached_volumes_list_content}</ul>	
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
