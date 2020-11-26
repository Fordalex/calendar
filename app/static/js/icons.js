$('#iconContainer img').on('click', function() {
    $('#submitButton').val(this.src);
    $('#selectedIcon').attr('src', this.src);
})