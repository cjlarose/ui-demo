<?php include 'header.php'; ?>

<script type="text/javascript">
$(function() {
	$('#running-instances-list li').draggable();
	$('#vm-killer').droppable({
		hoverClass: 'droppable-highlight',
		drop: function(event, ui) {
			$("<li></li>")
				.text(ui.draggable.text())
				.appendTo($(this).find('ul'))
				.draggable();
			$(ui.draggable).remove();
			$('#terminate-link').removeAttr('disabled');
		}
	});
	$('#running-instances').droppable({
		hoverClass: 'droppable-highlight',
		drop: function(event, ui) {
			$("<li></li>")
				.text(ui.draggable.text())
				.appendTo($(this).find('ul'))
				.draggable();
			$(ui.draggable).remove();
		}
	});
	$('#terminate-link').click(function(e) {
		e.preventDefault();
		$('#instances-to-terminate li').remove();
		return false;
	});
});
</script>

<h1>Virtual Machine Terminator</h1>
<p>Pick what you want VMs you want to terminate and drag them to the VM Killer. To confirm, select "terminate selected instances".</h1>
<div id="vm-killer-container">
	<div id="running-instances">
		<h2>Running Instances</h2>
		<ul id="running-instances-list">
			<li>iPlant Base Image vm142-26</li>
			<li>iPlant Base Image vm142-28</li>
			<li>iPlant Base Image vm142-68</li>
		</ul>
	</div>
	<div id="vm-killer">
		<h2>VM Killer</h2>
		<ul id="instances-to-terminate">
		</ul>
		<a id="terminate-link" class="btn btn-primary" disabled="disabled" href="#">Terminate selected instances</a>
	</div>
</div>
<?php include 'footer.php'; ?>
