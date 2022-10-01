</div>
<!-- Matomo -->
<script type="text/plain" data-cookiecategory="analytics">
  var _paq = window._paq = window._paq || [];
  _paq.push(['requireConsent']);
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="<?= $_ENV["mtmsrc"] ?>";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '<?= $_ENV["mtmid"] ?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->


<?php
get_template_part( "template-parts/elements/footer");
wp_footer(  );
?>
</body>
</html>