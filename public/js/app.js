console.log('App.js is loaded');

document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = new bootstrap.Modal(
        document.getElementById('deleteModal')
    );

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', () => {
            const action = button.dataset.action;
            const title = button.dataset.title;

            document.getElementById('deleteForm').action = action;
            document.getElementById('deleteTitle').textContent = title;

            deleteModal.show();
        });
    });
});
