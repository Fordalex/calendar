$('#eventForm').submit(function(e) {
    let eventInput = $('#eventInput').val();
    let iconInput = $('#submitButton').val();
    $('#eventErrorContainer').html('');
    $('#iconErrorContainer').html('');

    if (eventInput.includes("'")) {
        e.preventDefault();
        $('#eventErrorContainer').html("<p class='text-danger mt-1 mb-0'>Events cannot contain '</p>")
    }
    if (eventInput.length < 1) {
        e.preventDefault();
        $('#eventErrorContainer').html("<p class='text-danger mt-1 mb-0'>You haven't given your event a name.</p>")
    }
    if (iconInput.length < 1) {
        e.preventDefault();
        $('#iconErrorContainer').html("<p class='text-danger mt-1 mb-0'>You haven't selected an icon for your event.</p>")
    }
});