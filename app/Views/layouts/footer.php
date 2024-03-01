<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("#btn_logout").click(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>auth/logout',
            type: 'GET',
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Logout successful!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>auth/signin';
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>
</body>

</html>