</main>
<footer class="l-footer">
	<div class="l-footer__inner">
	</div>
</footer>
<?php if (is_front_page()): ?>
	<script>
		// トップへ戻る
		if (history.scrollRestoration) {
			history.scrollRestoration = "manual";
		}
		window.scrollTo(0, 0);
	</script>
<?php endif; ?>
<?php wp_footer(); ?>
</body>

</html>