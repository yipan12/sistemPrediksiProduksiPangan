const searchInput = document.getElementById("searchInput");
if (searchInput) {
    searchInput.addEventListener("input", function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll("tbody tr");

        tableRows.forEach(function (row) {
            const productName = row
                .querySelector("td:nth-child(2)")
                .textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
}
