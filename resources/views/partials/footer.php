</div>
</div>
</div>

<?php ?>


<footer class="container-fluid fixed-bottom text-center text-white bg-primary ">
    <p class="my-2">&copy; <?= date('Y') ?> - All rights reserved to HTU POS</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    <?php if (!empty($_SESSION['message-success'])) {?>
    toastr.success("<?= $_SESSION['message-success'] ?>");
   <?php } else if (!empty($_SESSION['message-error'])) { ?>
        toastr.error("<?= $_SESSION['message-error'] ?>");
    <?php } ?>


    $('#btn-account').on('click', function(e) {
        $('#btn-account').toggleClass('show');
        $('#dropdown-account-toggler').toggleClass('show');
    });

    $('#hamburger-toggler').on('click', function(e) {
        $('#hamburger-toggler').toggleClass('is-active');
    });

    $('#header-toggler').on('click', function(e) {
        $('#sidebar').toggleClass('closed-sidebar');
        $('#header-toggler').toggleClass('fa-solid fa-bars');
        $('#header-toggler').toggleClass('fa-solid fa-x');
    });

</script>
</body>

</html>