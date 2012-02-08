<?php
$volume_data = array(
	array('Volume 1', 'This volume does all kinds of things', '10'),
	array('Cool Volume', 'This volume does super super cool things, I promise!', '12'),
	array('Super super cool volume', 'This volume does cooler things than both volume 1 and volume 2 combined', '15'),
	array('Volume 1', 'This volume does all kinds of things', '10'),
	array('Cool Volume', 'This volume does super super cool things, I promise!', '12'),
	array('Super super cool volume', 'This volume does cooler things than both volume 1 and volume 2 combined', '15'),
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
	array('i-46190761', 'Image 1', 'emi-2F2B2523', 'New Base Image', '128.196.142.26', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-3A380612', 'Image 2', 'emi-2F2B2523', 'New Base Image', '128.196.142.68', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-46190763', 'Image 3', 'emi-2F2B2523', 'New Base Image', '128.196.142.29', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-46190764', 'Image 1', 'emi-2F2B2523', 'New Base Image', '128.196.142.26', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-3A380615', 'Image 2', 'emi-2F2B2523', 'New Base Image', '128.196.142.68', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-46190767', 'Image 3', 'emi-2F2B2523', 'New Base Image', '128.196.142.29', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-46190768', 'Image 1', 'emi-2F2B2523', 'New Base Image', '128.196.142.26', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-3A380619', 'Image 2', 'emi-2F2B2523', 'New Base Image', '128.196.142.68', 'primary', 'running', 1328630258, 'm1.small'),
	array('i-4619076A', 'Image 3', 'emi-2F2B2523', 'New Base Image', '128.196.142.29', 'primary', 'running', 1328630258, 'm1.small')
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
<?php include 'header.php'; ?>

<script type="text/javascript">
$(function() {
	$('#vols-list li')
		.addClass('unattached')
		.draggable({revert: 'invalid', appendTo: 'body', helper: 'clone'});
	$('#vols-instances-list > li').droppable({
		hoverClass: 'droppable-highlight',
		accept: '.unattached',
		drop: function(event, ui) {
			$("<li></li>")
				.html(ui.draggable.html())
				.appendTo($(this).find('ul.attached-volumes-list'))
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
		},
		over: function (event, ui) {
			console.log($(this).find('.nav-tabs a:eq(1)'));
			$(this).find('.nav-tabs a:eq(1)').tab('show');
		}
	});
});
</script>

<h1>Volume Management</h1>
<p>To attach a volume, drag it from the column on the left onto an instance on the right.</p>
<div id="unified" class="row">
	<div id="instances-panel" class="span8">
		<h2>Running instances</h2>
		<ul id="vols-instances-list">
<?php
foreach ($instances as $instance) {
	$meta_content = "<dl>";
	foreach ($instance as $key => $value) 
		$meta_content .= "<dt>{$key}</dt><dd>{$value}</dd>";
	$meta_content .= "</dl>";
	echo "\t\t\t<li>
				<h3>{$instance->name} ({$instance->id})</h3>
				<p>{$instance->description}</p>
	<div class=\"tabbable\">
  <ul class=\"nav nav-tabs\">
    <li class=\"active\"><a href=\"#{$instance->id}-meta\" data-toggle=\"tab\">Instance meta</a></li>
    <li><a href=\"#{$instance->id}-volumes\" data-toggle=\"tab\">Attached Volumes</a></li>
  </ul>
  <div class=\"tab-content\">
    <div class=\"tab-pane active instance-meta\" id=\"{$instance->id}-meta\">
{$meta_content}
    </div>
    <div class=\"tab-pane\" id=\"{$instance->id}-volumes\">
		<ul class=\"attached-volumes-list\"></ul>	
    </div>
  </div>
</div>		
			</li>\n";
}
?>
		</ul>
		<a href="#" class="btn btn-primary">Apply Changes</a>
	</div>
	<div id="volumes-panel" class="span4">
		<h2>Unmounted Volumes</h2>
		<ul id="vols-list">
<?php
foreach ($volumes as $volume) {
	echo "\t\t\t<li><h3>{$volume->name} ({$volume->size} GB)</h3><p>{$volume->description}</p></li>\n";	
}
?>
		</ul>
	</div>
</div>
<?php
?>

<?php include 'footer.php'; ?>
