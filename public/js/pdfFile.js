document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('pdfFile');
    const status = document.getElementById('pdfStatus');

    if (!input) return;

    input.addEventListener('change', () => {
        if (input.files.length === 0) return;

        const file = input.files[0];
        const formData = new FormData();
        formData.append('file', file, file.name);

        // tampilkan status
        status.classList.remove('d-none');
        status.innerText = 'Membaca metadata PDF...';

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
        .then(async res => {
            if (!res.ok) throw new Error("HTTP " + res.status);
            return res.json();
        })
        .then(data => {
            console.log('RESPONSE:', data);

            if (data.success) {
                setValue('judul', data.title);
                setValue('penulis', data.author);
                setValue('isbn', data.isbn);
                setValue('penerbit', data.publisher);
                setValue('tahun_terbit', data.year);
                setValue('edisi', data.edition);
                setValue('kota_terbit', data.city);

                status.innerText = 'Metadata PDF berhasil dibaca ✔';
            } else {
                status.innerText = 'Metadata tidak ditemukan';
            }
        })
        .catch(err => {
            console.error(err);
            status.innerText = 'Gagal membaca metadata PDF';
        });
    });

    function setValue(name, value) {
        const el = document.querySelector(`[name="${name}"]`);
        if (el && !el.value) { 
            el.value = value ?? '';
        }
    }
});
