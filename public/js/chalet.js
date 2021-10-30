$("#add_picture").click(function() {
    const index = +$("#widgets-counter").val();

    const tmpl = $("#chalet_pictures").data("prototype").replace(/__name__/g, index);

    $("#chalet_pictures").append(tmpl);

    $("#widgets-counter").val(index + 1);

    handleDeleteButton();
});

function handleDeleteButton() {

    $('button[data-action="delete"]').click(function() {

        const target = this.dataset.target;

        $(target).remove();
    });
}


function updateCounter() {

    const count = $("#chalet_pictures div.form-group").length;

    $("#widgets-counter").val(count);

}

updateCounter();

handleDeleteButton();

$(function() {
    $("#loadMedia").on("click", function(e) {
        e.preventDefault();
        $("div.load-media").removeClass("d-none");
        $("#loadMedia").addClass("d-none");
        $("#hideMedia").removeClass("d-none");
    });
    $("#hideMedia").on("click", function(e) {
        e.preventDefault();
        $("div.load-media").addClass("d-none");
        $("#loadMedia").removeClass("d-none");
        $("#hideMedia").addClass("d-none");
    });

});