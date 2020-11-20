$('#choreForm').submit(function(e) {
    let choreInput = $('#choreInput').val();
    let iconInput = $('#submitButton').val();
    $('#choreErrorContainer').html('');
    $('#iconErrorContainer').html('');

    if (choreInput.includes("'")) {
        e.preventDefault();
        $('#choreErrorContainer').html("<p class='text-danger mt-1 mb-0'>Chores cannot contain '</p>")
    }
    if (choreInput.length < 1) {
        e.preventDefault();
        $('#choreErrorContainer').html("<p class='text-danger mt-1 mb-0'>You haven't given your chore a name.</p>")
    }
    if (iconInput.length < 1) {
        e.preventDefault();
        $('#iconErrorContainer').html("<p class='text-danger mt-1 mb-0'>You haven't selected an icon for your chore.</p>")
    }
    if ($('#categoryInput').val() === undefined) {
        e.preventDefault();
        $('#categoryErrorContainer').html("<p class='text-danger mt-1 mb-0'>First you need to create a category.</p>")
    }
});