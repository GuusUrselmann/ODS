$(".deleteConfirmModal").click(function () {
    Swal.fire({
        title: "Weet u het zeker?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ja, verwijder!",
        cancelButtonText: "Annuleren",
    }).then((result) => {
        if (result.value) {
            window.location.replace($(this).attr("data-href"));
        }
    });
});