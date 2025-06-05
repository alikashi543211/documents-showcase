<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        const $selectAll = $("#selectAll");
        const $checkboxes = $(".doc-checkbox");
        const $downloadBtn = $("#downloadBtn");

        function updateUI() {
            const anyChecked = $checkboxes.is(":checked");
            $downloadBtn.css("display", anyChecked ? "block" : "none");

            selectedIds = []; // Reset array before repopulating

            $checkboxes.each(function() {
                const $cb = $(this);
                const $card = $cb.closest(".document-card");
                const docId = $card.attr("data-document-id");
                $card.toggleClass("selected", this.checked);

                if (this.checked) {
                    selectedIds.push(docId);
                }
            });

            $selectAll.prop("checked", $checkboxes.length === $checkboxes.filter(":checked").length);

            const idString = selectedIds.join(','); // Convert array to comma-separated string
            console.log("Selected IDs:", idString);
            $("#downloadBtn").attr('data-document-ids', idString)
        }


        $checkboxes.on("change", updateUI);

        $selectAll.on("change", function() {
            const isChecked = this.checked;
            $checkboxes.prop("checked", isChecked);
            updateUI();
        });
    });

    $(document).on('click', "#downloadBtn", function() {
        var document_ids = $(this).attr('data-document-ids');

        console.log(document_ids);

        // Redirect with document_ids as a query string parameter
        window.location.href = "/download-documents?ids=" + encodeURIComponent(document_ids);
    });
</script>

<script>
    setTimeout(() => {
        $('#popupAlert').fadeOut('slow');
    }, 2000);
</script>
