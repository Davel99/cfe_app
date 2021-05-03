</main>

</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Bootstrap core JavaScript -->
<script src='<?= base_url ?>vendor/jquery/jquery.min.js'></script>
<script src="<?= base_url ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php if (is_file("./assets/js/$cont/$action.js")): ?> 

        <script>
                var base_url = "<?= base_url ?>";
        </script>

        <script src="<?= base_url ?>assets/js/<?= $cont ?>/<?= $action ?>.js"></script>

<?php endif; ?>
<!-- Menu Toggle Script -->
<script>
        $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
        });
</script>


</body>
</html>
