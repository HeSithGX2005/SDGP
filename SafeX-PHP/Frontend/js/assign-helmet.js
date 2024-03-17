document.addEventListener('DOMContentLoaded', function() {
    var assignButtons = document.querySelectorAll('.assign-btn');

    assignButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var userId = this.getAttribute('data-userid');
            window.location.href = 'assign-helmet.php?user_id=' + userId;
        });
    });
});