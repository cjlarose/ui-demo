<?php
include 'model.php';
$instances_set = Instance::get_all_with_volumes();
$instances = $instances_set->results;
?>
<?php include 'header.php'; ?>
<script type="text/javascript">
$.fn.slide = function(slide) {
	if (slide == undefined) 
		console.log(this);
	else {
	//	$(this).scrollLeft($(this).width() * slide);
		$(this).animate({
			scrollLeft: $(this).width() * slide
		}, 'slow');
	}
};

$(function() {
	$('#slider-container').slide();
	$('#vols-instances-list > li').click(function() {
		console.log($(this).attr('data-instance'));
		offset = $('#instance-' + $(this).attr('data-instance')).position().top;
		$('#view-instance').scrollTop(offset - $('#view-instance > div:eq(0)').position().top);
	//	$('#view-instance').scrollTop();
			//$('view_instance');
		$('#slider-container').slide(1);
	});
});
</script>

<h1>Instance management</h1>
<p>To attach a volume, drag it from the column on the left onto an instance on the right.</p>
<div id="slider-container">
	<div class="slides">
		<div id="instances-panel">
			<h2>Running instances</h2>
			<ul id="vols-instances-list">
<?php
foreach ($instances as $instance) {
	echo "\t\t\t<li data-instance=\"{$instance->id}\">
				<h3>{$instance->name} ({$instance->id})</h3>
				<p>{$instance->description}</p>
	";
}
?>
			</ul>
			<a href="#" class="btn btn-primary">Apply Changes</a>
		</div>
		<div id="view-instance">
<?php foreach($instances as $instance): ?>
			<div id="instance-<?php echo $instance->id; ?>" class="row">
				<div class="span7">
					<h2><?php echo $instance->name; ?></h2>
					<p><?php echo $instance->description; ?></p>
					<a class="btn terminate-instance-button">Terminate Instance</a>	
<?php
					$meta_content = "<dl>";
					foreach ($instance as $key => $value) 
						$meta_content .= "<dt>{$key}</dt><dd>{$value}</dd>";
					$meta_content .= "</dl>";
					
					$attached_volumes_list_content = "";
					foreach ($instance->Volume as $volume)
						$attached_volumes_list_content .= "<li><h3>{$volume->name}</h3><p>{$volume->description}</p></li>";

	echo "<div class=\"tabbable\">
  <ul class=\"nav nav-tabs\">
    <li class=\"active\"><a href=\"#{$instance->id}-meta\" data-toggle=\"tab\">Instance meta</a></li>
    <li><a href=\"#{$instance->id}-volumes\" data-toggle=\"tab\">Attached Volumes</a></li>
  </ul>
  <div class=\"tab-content\">
    <div class=\"tab-pane active instance-meta\" id=\"{$instance->id}-meta\">
{$meta_content}
    </div>
    <div class=\"tab-pane\" id=\"{$instance->id}-volumes\">
		<ul class=\"attached-volumes-list\">{$attached_volumes_list_content}</ul>	
    </div>
  </div>
</div>		
			</li>\n";
?>
				</div>
				<div class="span4">
					hello sidebar
				</div>
			</div>
<?php endforeach; ?>
		</div>
	</div>
<!--	
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
-->
</div>
<?php
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Used', 3],
          ['Unused', 7]
        ]);

        // Set chart options
        var options = {
		'title': 'Disk Use (GB)',
                'width':300,
                'height':300,
		legend: {
			position: 'top' 
		}
	};

        // Instantiate and draw our chart, passing in some options.
	$('#view-instance > div > div.span4').each(function(i, e) {
		console.log(e, i);
		var chart = new google.visualization.PieChart(e);
		chart.draw(data, options);
	});
      }
    </script>
<?php include 'footer.php'; ?>
