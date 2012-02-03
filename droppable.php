<?php include 'header.php'; ?>

<script type="text/javascript">
$(function() {
	$('.draggable').draggable();
});
</script>

<h1>Pick what you want VMs you want to terminate and drag them to the Terminator</h1>
<div id="vm-killer-container">
	<div id="running-instances">
		<h2>Running Instances</h2>
		<ul id="running-instances-list">
			<li>vm142-26</li>
			<li>vm142-28</li>
			<li>vm142-68</li>
		</ul>
	</div>
	<div id="vm-killer"><h2>VM Killer</h2></div>
</div>
<?php include 'footer.php'; ?>
