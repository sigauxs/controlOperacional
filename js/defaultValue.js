Date.prototype.toDateInputValue = (function() {
    let local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});


$(document).ready( function() {
    console.log(document.querySelector('#ini'));
    $('#ini').val(new Date().toDateInputValue());
});