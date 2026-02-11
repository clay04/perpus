document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('pdfFile');
    if (!input) return;

    input.addEventListener('change', () => {
        if (input.files.length === 0) return;

        const file = input.files[0];

        const formData = new FormData();
        formData.append('file', file, file.name); // ⬅️ PENTING

        fetch(input.dataset.parseUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            console.log('RESPONSE:', data);

            if (data.success) {
                document.querySelector('[name="judul"]').value = data.title ?? '';
                document.querySelector('[name="penulis"]').value = data.author ?? '';
            }
        })
        .catch(err => console.error(err));
    });
});

