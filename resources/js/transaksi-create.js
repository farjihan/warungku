document.addEventListener('DOMContentLoaded', () => {
    const keranjang = document.getElementById('keranjang');
    const itemTemplate = document.getElementById('item-template');
    const barangOptions = getOriginalOptions();

    // Inisialisasi item awal yang sudah ada di halaman
    keranjang.querySelectorAll('.item').forEach(item => {
        const select = item.querySelector('select');
        const selectedValue = select.value;

        // Isi ulang dropdown TANPA kehilangan selected
        isiDropdown(select, barangOptions, selectedValue);

        // Set harga default sesuai data-harga dari option yang terpilih
        isiHarga(select);

        aktifkanPencarian(item);
    });

    window.tambahItem = () => {
        const clone = itemTemplate.content.cloneNode(true);
        keranjang.appendChild(clone);
        const newItem = keranjang.lastElementChild;

        const select = newItem.querySelector('select');
        isiDropdown(select, barangOptions);

        aktifkanPencarian(newItem);
    };

    window.hapusItem = (btn) => {
        const item = btn.closest('.item');
        if (keranjang.querySelectorAll('.item').length > 1) {
            item.remove();
        } else {
            alert("Minimal satu barang harus ada.");
        }
    };
});

function getOriginalOptions() {
    const select = document.querySelector('.item select');
    return Array.from(select.options).map(opt => ({
        value: opt.value,
        text: opt.text,
        harga: opt.dataset.harga
    }));
}

function isiDropdown(select, options, selectedValue = null) {
    select.innerHTML = '';

    options.forEach(opt => {
        const o = document.createElement('option');
        o.value = opt.value;
        o.text = opt.text;
        o.dataset.harga = opt.harga;
        if (selectedValue && selectedValue == opt.value) {
            o.selected = true;
        }
        select.appendChild(o);
    });
}

function aktifkanPencarian(item) {
    const select = item.querySelector('select');
    const input = item.querySelector('.search-barang');
    const hargaInput = item.querySelector('.harga-satuan');

    const options = getOriginalOptions();

    select.addEventListener('change', () => isiHarga(select));

    if (input) {
        input.addEventListener('input', () => {
            const keyword = input.value.toLowerCase();
            isiDropdown(select, options.filter(opt => opt.text.toLowerCase().includes(keyword)));
        });
    }
}

function isiHarga(select) {
    const harga = select.selectedOptions[0]?.dataset.harga || 0;
    const container = select.closest('.item');
    const hargaInput = container.querySelector('.harga-satuan');
    const jumlahInput = container.querySelector('input[name="jumlah[]"]');
    if (hargaInput) hargaInput.value = harga;
    if (jumlahInput) jumlahInput.focus();
}
