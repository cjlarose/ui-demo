    <?php $source = ob_get_clean(); ?>
		<div id="content">
<?php echo $source; ?>
		</div>
		<?php if($body_class != 'page-sliding'): ?>
		<div id="source">
			<h2>Source Code</h2>
<pre class="prettyprint"><?php echo htmlspecialchars(trim($source)); ?></pre>
		</div>
		<?php endif; ?>
	</div> <!-- /container -->

  </body>
</html>

