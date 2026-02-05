console.log('App.js is loaded');

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('Yakin hapus buku ini?')) {
                e.preventDefault();
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-form-user').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('Yakin hapus buku ini?')) {
                e.preventDefault();
            }
        });
    });
});