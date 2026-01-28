document.addEventListener('DOMContentLoaded', () => {
    const search = document.getElementById('search');
    search.addEventListener('keyup', () => {
        fetch('search.php?q=' + search.value)
            .then(res => res.text())
            .then(data => document.getElementById('results').innerHTML = data);
    });
});