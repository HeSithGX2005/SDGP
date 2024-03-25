function handleButtonClicked(url, method, data) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json', // Expect JSON response
        success: function(response) {
            // Display SweetAlert message based on response
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then(function(result) { 
                    location.replace(location.href);
                  });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
            // Optionally, you can reload the page or remove the deleted employee from the DOM
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            console.error(xhr.responseText);
        }
    });
}
