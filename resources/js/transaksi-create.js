document.addEventListener('DOMContentLoaded', () => {
    function tambahItem() {
        const keranjang = document.getElementById('keranjang');
        const item = keranjang.querySelector('.item');
        const clone = item.cloneNode(true);

        // Kosongkan semua input
        clone.querySelectorAll('input').forEach(input => input.value = '');

        // Reset select ke default
        const select = clone.querySelector('select');
        if (select) {
            const options = JSON.parse(select.dataset.originalOptions);
            select.innerHTML = '';
            options.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.text = opt.text;
                option.setAttribute('data-harga', opt.dataHarga); // penting
                select.appendChild(option);
            });
        }

        keranjang.appendChild(clone);
        aktifkanPencarian(clone); // aktifkan search kembali
    }

    window.tambahItem = tambahItem;

    window.hapusItem = function (btn) {
        const item = btn.closest('.item');
        const keranjang = document.getElementById('keranjang');
        if (keranjang.querySelectorAll('.item').length > 1) {
            item.remove();
        } else {
            alert('Minimal satu barang harus ada.');
        }
    };

    document.querySelectorAll('.item').forEach(item => aktifkanPencarian(item));
});

function aktifkanPencarian(item) {
    const searchInput = item.querySelector('.search-barang');
    const select = item.querySelector('select');

    if (!select.dataset.originalOptions) {
        const originalOptions = Array.from(select.options).map(opt => ({
            value: opt.value,
            text: opt.text,
            dataHarga: opt.getAttribute('data-harga'),
        }));
        select.dataset.originalOptions = JSON.stringify(originalOptions);
    }

    const hargaInput = item.querySelector('.harga-satuan');

    select.addEventListener('change', function () {
        isiHarga(select);
    });

    searchInput?.addEventListener('input', () => {
        const keyword = searchInput.value.toLowerCase();
        const options = JSON.parse(select.dataset.originalOptions);

        select.innerHTML = ''; // kosongkan dulu

        options
            .filter(opt => opt.text.toLowerCase().includes(keyword))
            .forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.text = opt.text;
                option.setAttribute('data-harga', opt.dataHarga);
                select.appendChild(option);
            });
    });
}

function isiHarga(selectEl) {
    const harga = selectEl.options[selectEl.selectedIndex].getAttribute('data-harga');
    const container = selectEl.closest('.item');
    const hargaInput = container.querySelector('.harga-satuan');
    const jumlahInput = container.querySelector('input[name="jumlah[]"]');

    if (hargaInput) hargaInput.value = harga;
    if (jumlahInput) jumlahInput.focus();
}
