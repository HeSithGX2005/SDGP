function deleteItem(url, callback) {
        // Ask for confirmation before deletion
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        // If the deletion is successful, remove the corresponding row from the table
                        if(response == 'success'){
                            if(callback && typeof callback === 'function') {
                                callback();
                            }
                            Swal.fire(
                                'Deleted!',
                                'Your item has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the item.',
                                'error'
                            );
                        }
                    },
                    error: function(){
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the item.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    $(document).ready(function(){
        $(".delete-btn").click(function(e){
            e.preventDefault(); // Prevent the default behavior of the link
            var url = $(this).attr('href'); // Get the URL from the link's href attribute
            deleteItem(url, function(){
                $(e.target).closest('tr').remove();
            });
        });
    });
