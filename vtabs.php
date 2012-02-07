<?php include 'header.php'; ?>
<script>
$(function() {
	$('.container').addClass('container-fluid').removeClass('container');
	$('a[href="#volumes"]').on('show', function (e) {
		$($(e.target).attr('href')).load('volumes.php #content>*', function() {});
	})
	$('a[href="#instances"]').on('show', function (e) {
		$($(e.target).attr('href')).load('instances.php #content>*', function() {});
	})
});
</script>
<div class="tabbable tabs-left row-fluid">
  <ul class="nav nav-tabs span3">
    <li class="active"><a href="#1" data-toggle="tab">Applications</a></li>
    <li><a href="#instances" data-toggle="tab">Instances</a></li>
    <li><a href="#volumes" data-toggle="tab">Volumes</a></li>
    <li><a href="#4" data-toggle="tab">Authentication Keys</a></li>
  </ul>
  <div class="tab-content span8">
    <div class="tab-pane active" id="1">
      <p>I'm in Section 1.</p>
    </div>
    <div class="tab-pane" id="instances">
    </div>
    <div class="tab-pane" id="volumes">
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
