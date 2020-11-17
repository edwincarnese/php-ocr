<script type="text/javascript">
    const toastMessage = "<?php echo isset($_SESSION["toastMessage"]) ? $_SESSION["toastMessage"] : '' ?>";
    const toastType = "<?php echo isset($_SESSION["toastType"]) ? $_SESSION["toastType"] : '' ?>";
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });

        if(toastMessage != '' && toastType != '') {
            Toast.fire({
                icon: toastType,
                title: toastMessage
            })    
        }
    });
</script>

<?php 
if(isset($_SESSION["toastMessage"]) || isset($_SESSION["toastType"])) {
    unset($_SESSION["toastMessage"]);
    unset($_SESSION["toastType"]);
}
?>