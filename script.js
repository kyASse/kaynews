function performSearch() {
    const searchInput = document.getElementById('searchInput').value.trim();

    if (searchInput === '') {
        alert('Silakan masukkan kata kunci pencarian.');
        return;
    }

    fetch('search.php?search=' + encodeURIComponent(searchInput))
        .then(response => response.json())
        .then(data => {
            const searchResultsElement = document.getElementById('search-results');
            if (data.length === 0) {
                searchResultsElement.innerHTML = '<p>Tidak ada hasil pencarian.</p>';
            } else {
                let resultHTML = '<ul>';
                data.forEach(item => {
                    resultHTML += `<li><a href="detail.php?id=${item.id}">${item.title}</a> - ${item.body.substring(0, 50)}...</li>`;
                });
                resultHTML += '</ul>';
                searchResultsElement.innerHTML = resultHTML;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('search-results').innerHTML = '<p>Terjadi kesalahan saat melakukan pencarian.</p>';
        });
}