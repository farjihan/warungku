document.addEventListener('DOMContentLoaded', () => {
    const keranjang = document.getElementById('keranjang');
    const itemTemplate = document.getElementById('item-template');
    const barangOptions = getOriginalOptions();

    // Inisialisasi item awal
    keranjang.querySelectorAll('.item').forEach(item => {
        isiDropdown(item.querySelector('select'), barangOptions);
        aktifkanPencarian(item);
    });

    window.tambahItem = () => {
        const clone = itemTemplate.content.cloneNode(true);
        keranjang.appendChild(clone);
        const newItem = keranjang.lastElementChild;
        isiDropdown(newItem.querySelector('select'), barangOptions);
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

function isiDropdown(select, options) {
    select.innerHTML = '';
    options.forEach(opt => {
        const o = document.createElement('option');
        o.value = opt.value;
        o.text = opt.text;
        o.dataset.harga = opt.harga;
        select.appendChild(o);
    });
}

function aktifkanPencarian(item) {
    const select = item.querySelector('select');
    const input = item.querySelector('.search-barang');
    const hargaInput = item.querySelector('.harga-satuan');
    const jumlahInput = item.querySelector('input[name="jumlah[]"]');
    const options = getOriginalOptions();

    select.addEventListener('change', () => isiHarga(select));
    input?.addEventListener('input', () => {
        const keyword = input.value.toLowerCase();
        isiDropdown(select, options.filter(opt => opt.text.toLowerCase().includes(keyword)));
    });
}

function isiHarga(select) {
    const harga = select.selectedOptions[0]?.dataset.harga || 0;
    const container = select.closest('.item');
    const hargaInput = container.querySelector('.harga-satuan');
    const jumlahInput = container.querySelector('input[name="jumlah[]"]');
    if (hargaInput) hargaInput.value = harga;
    if (jumlahInput) jumlahInput.focus();
}
