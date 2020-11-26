$('#categoryForm').submit(function(e) {
    let categoryInput = $('#categoryInput').val();
    $('#categoryErrorContainer').html('');

    if (categoryInput.includes("'")) {
        e.preventDefault();
        $('#categoryErrorContainer').html("<p class='text-danger mt-1 mb-0'>Category cannot contain '</p>")
    }
    if (categoryInput.length < 1) {
        e.preventDefault();
        $('#categoryErrorContainer').html("<p class='text-danger mt-1 mb-0'>You haven't given your category a name.</p>")
    }
});