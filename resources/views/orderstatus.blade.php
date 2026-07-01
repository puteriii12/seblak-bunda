@extends('layouts.orderstatus')

@section('title', 'Pesanan Berhasil - Seblak Bunda')

@section('content')
<div class="success-container">
    {{-- Icon --}}
    <div class="success-icon">
        <div class="icon-circle">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                {{-- Shopping Bag --}}
                <path d="M16 24L20 52C20 54 22 56 24 56H40C42 56 44 54 44 52L48 24" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 24H48" stroke="white" stroke-width="3" stroke-linecap="round"/>
                <path d="M24 24V16C24 12 28 8 32 8C36 8 40 12 40 16V24" stroke="white" stroke-width="3" stroke-linecap="round"/>
                {{-- Smile Face --}}
                <circle cx="27" cy="36" r="2" fill="white"/>
                <circle cx="37" cy="36" r="2" fill="white"/>
                <path d="M28 42C28 42 30 44 32 44C34 44 36 42 36 42" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
    </div>

    {{-- Title --}}
    <h1 class="success-title">Silahkan bayar di kasir dulu ya</h1>

    {{-- Informasi Pemesan --}}
    <div class="section-title">Informasi Pemesan</div>
    <div class="info-card">
        <div class="info-row">
            <span class="info-label" id="customerName">Ahmad Akakom</span>
            <span class="info-value" id="orderType">Dine In</span>
        </div>
        <div class="info-row">
            <span class="info-label">Nomor Pesanan</span>
            <span class="info-value" id="orderId">2134382493894</span>
        </div>
        <div class="info-row">
            <span class="info-label">Waktu Pemesanan</span>
            <span class="info-value" id="orderTime">18 Jan 2026 | 13.00</span>
        </div>
    </div>

    {{-- Daftar Pesanan --}}
    <div class="section-title">Daftar Pesanan</div>
    <div class="order-card">
        <div id="orderItems">
            {{-- Items akan di-render oleh JavaScript --}}
        </div>
        
        <div class="order-total">
            <span class="total-label">TOTAL</span>
            <span class="total-value" id="totalAmount">Rp. 3.000</span>
        </div>
    </div>

    {{-- Button Cek Status --}}
    <button class="btn-cek-status" onclick="checkStatus()">
        Cek Status
    </button>
</div>

@endsection

@push('scripts')
<script>
    // Load order data dari localStorage
    const order = JSON.parse(localStorage.getItem('currentOrder') || '{}');

    // Display order information
    document.getElementById('customerName').textContent = order.customer?.name || '-';
    document.getElementById('orderType').textContent = order.orderType === 'dine-in' ? 'Dine In' : 'Take Away';
    document.getElementById('orderId').textContent = order.orderId || '-';
    
    // Format waktu pemesanan
    const orderDate = new Date(order.createdAt);
    const formattedDate = orderDate.toLocaleDateString('id-ID', { 
        day: 'numeric', 
        month: 'short', 
        year: 'numeric' 
    });
    const formattedTime = orderDate.toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
    document.getElementById('orderTime').textContent = `${formattedDate} | ${formattedTime}`;

    // Render order items
    const itemsContainer = document.getElementById('orderItems');
    let itemsHTML = '';
    let totalAmount = 0;

    // Data produk untuk gambar
    const productData = {
        'Kerupuk Orange': { price: 1000, image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiEOklV1QQzk87QXk7nzwPehBQgfRzBhnih6PkMP0pmNH-fYWgZIuoXWY&s=10' },
        'Cikur': { price: 1000, image: 'https://down-id.img.susercontent.com/file/id-11134207-7ra0h-mdgomv5b22rw84' },
        'Siomay Kering': { price: 1000, image: 'https://down-id.img.susercontent.com/file/06d421f23583ced3add8e4239109a8a9' },
        'Cuanki': { price: 1000, image: 'https://laz-img-sg.alicdn.com/p/b56f776be95dd776954908160a6ab819.jpg' },
        'Dumpling Keju': { price: 2000, image: 'https://down-id.img.susercontent.com/file/9ce501172d94079a11b20957d66ba0be' },
        'Bakso': { price: 1000, image: 'https://i0.wp.com/i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/7c4483e7-a99b-4887-ae8d-ab47e45a593f_Go-Biz_20211208_174356.jpeg' },
        'Crab Stick': { price: 2000, image: 'https://cdn.grid.id/crop/0x0:0x0/filters:format(webp):quality(100)/photo/2018/10/07/1210471840.jpg' },
        'Fish Roll': { price: 198000, image: 'https://pasarsegar.co.id/wp-content/uploads/2022/03/image_picker6751492691753706410-1.jpg' },
        'Ceker Ayam': { price: 2000, image: 'https://foto.kontan.co.id/pA0pw7S3rZfL3ZSeV1acZcaqhGc=/smart/filters:format(webp)/2023/04/09/1311779193.jpg' },
        'Tulang Rangu': { price: 3000, image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_HbKCwA_4FfUDqbTOeEgEGd7Ss9mBBpDiJFpsBlaDOm4Melr6KIOBtZo&s=10' },
        'Telur Puyuh': { price: 2000, image: 'https://kareo-jawilan.desa.id/wp-content/uploads/2023/09/telur-puyuh.jpg' },
        'Sawi': { price: 1000, image: 'https://i0.wp.com/resepkoki.id/wp-content/uploads/2018/02/sawi-hijau.jpg?fit=700%2C465&ssl=1' },
        'Kangkung': { price: 1000, image: 'https://puskesmasjakem-dikes.lombokbaratkab.go.id/media/crop/2025/02/11/59-20250211-083030-652715.jpg' },
        'Jamur Kuping': { price: 1000, image: 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/e3bc6af4-f527-4ebb-91cd-ad3cfef04a84_Go-Biz_20230307_100902.jpeg' }
    };

    for (let name in order.items) {
        const item = order.items[name];
        const product = productData[name] || { price: item.price, image: '' };
        const itemTotal = item.qty * item.price;
        totalAmount += itemTotal;

        itemsHTML += `
            <div class="order-item">
                <img src="${product.image}" alt="${name}" class="item-image">
                <div class="item-details">
                    <div class="item-name">${name}</div>
                    <div class="item-qty">${item.qty}x</div>
                </div>
                <div class="item-price">Rp. ${itemTotal.toLocaleString('id-ID')}</div>
            </div>
        `;
    }

    itemsContainer.innerHTML = itemsHTML;
    document.getElementById('totalAmount').textContent = `Rp. ${totalAmount.toLocaleString('id-ID')}`;

    // Fungsi Cek Status
    function checkStatus() {
        // Redirect ke halaman tracking status
        window.location.href = '/order_sukses';
    }
</script>
@endpush