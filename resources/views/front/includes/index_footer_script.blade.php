<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".doc-checkbox");
    const downloadBtn = document.getElementById("downloadBtn");

    function updateUI() {
        const anyChecked = Array.from(checkboxes).some((cb) => cb.checked);
        downloadBtn.style.display = anyChecked ? "block" : "none";

        checkboxes.forEach((cb) => {
            const card = cb.closest(".document-card");
            card.classList.toggle("selected", cb.checked);
        });

        selectAll.checked = Array.from(checkboxes).every((cb) => cb.checked);
    }

    checkboxes.forEach((cb) => {
        cb.addEventListener("change", updateUI);
    });

    selectAll.addEventListener("change", () => {
        checkboxes.forEach((cb) => (cb.checked = selectAll.checked));
        updateUI();
    });
</script>

<script>
    setTimeout(() => {
        $('#popupAlert').fadeOut('slow');
    }, 2000);
</script>
