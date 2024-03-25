<?php if (count($errors) > 0) : ?>
    <script>
        $(document).ready(function() {
            var errorMessages = '';
            <?php foreach ($errors as $error) : ?>
                errorMessages += '<?php echo $error; ?><br>';
            <?php endforeach ?>
            toastr.options = {
				showDuration: '1000',
				hideDuration: '1000',
				timeOut: '5000',
				extendedTimeOut: '1000',
				showEasing: 'swing',
                positionClass: 'toast-top-center',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            };
            toastr.error(errorMessages, 'Login Error');
        });
    </script>
<?php endif ?>