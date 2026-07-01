@extends('layouts.checkout')

@section('title', 'Checkout - Seblak Bunda')

@section('content')
    {{-- Header --}}
    <div class="checkout-header">
        <div class="header-left">
            <button class="back-btn" onclick="goBack()">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div class="header-title">Seblak Bunda</div>
        </div>
    </div>

    {{-- Content --}}
    <div class="checkout-content">

        {{-- Informasi Pelanggan --}}
        <div class="checkout-section">
            <h2 class="section-title">Informasi Pelanggan</h2>

            <div class="form-group">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-input" id="customerName" placeholder="Isikan namamu yaa">
            </div>

            <div class="form-group">
                <label class="form-label">No Telp</label>
                <input type="tel" class="form-input" id="customerPhone" placeholder="Isikan nomor telepon kamu">
            </div>

            <div class="form-group">
                <label class="form-label">Level Pedas</label>
                <select class="form-select" id="spicyLevel">
                    <option value="">Pilih level pedasmu</option>
                    <option value="0">Level 0 - Tidak Pedas</option>
                    <option value="1">Level 1 - Pedas Sedikit</option>
                    <option value="2">Level 2 - Pedas Sedang</option>
                    <option value="3">Level 3 - Pedas</option>
                    <option value="4">Level 4 - Pedas Banget</option>
                    <option value="5">Level 5 - Super Pedas</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Dine In / Take Away</label>
                <select class="form-select" id="orderType">
                    <option value="">Pilih</option>
                    <option value="dine-in">Dine In</option>
                    <option value="take-away">Take Away</option>
                </select>
                <div class="form-hint">Untuk pembayaran Take Away hanya bisa QRIS</div>
            </div>
        </div>

        {{-- Item Section --}}
        <div class="item-section">
            <h2 class="item-title">Item</h2>
            <div id="cartItemsContainer">
                {{-- Items akan di-render oleh JavaScript --}}
            </div>
        </div>

        {{-- Note Section --}}
        <div class="note-section">
            <label class="note-label">Note *optional</label>
            <input type="text" class="form-input" id="orderNote" placeholder="Isikan note">
        </div>

        {{-- Topping Section --}}
        <div class="topping-section">
            <div class="topping-text">Mau tambah topping?</div>
            <button class="btn-tambah" onclick="addTopping()">Tambah</button>
        </div>

        {{-- Summary Section --}}
        <div class="summary-section">
            <div class="summary-row">
                <div class="summary-label">Delivery fee</div>
                <div>
                    <span class="summary-value strikethrough">Rp20.000</span>
                    <span class="summary-value free">Free</span>
                </div>
            </div>
            <div class="summary-row">
                <div class="summary-label" style="font-weight: 700; font-size: 18px;">Total payment</div>
                <div class="summary-value" style="font-size: 20px;" id="totalPayment">Rp0</div>
            </div>
            <div class="view-details" onclick="viewDetails()">View details</div>
        </div>

        {{-- Payment Section --}}
        <div class="payment-section">
            <div class="payment-method">
                <select class="payment-select" id="paymentMethod">
                    <option value="qris">QRIS</option>
                    <option value="cash">Bayar Ditempat</option>
                </select>
                <span class="payment-total" id="paymentTotal">Rp0</span>
            </div>
        </div>

    </div>

    {{-- Place Order Button --}}
    <button class="place-order-btn" onclick="placeOrder()">Place order</button>

@endsection

@push('scripts')
    <script>
        // Load cart dari localStorage
        let cart = {};
        const savedCart = localStorage.getItem('seblakBundaCart');

        if (savedCart) {
            cart = JSON.parse(savedCart);
        }

        // Data produk (simulasi - di production bisa dari API/database)
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

        // Render cart items
        function renderCartItems() {
            const container = document.getElementById('cartItemsContainer');

            if (Object.keys(cart).length === 0) {
                container.innerHTML = `
                        <div class="empty-cart">
                            <i class="bi bi-cart-x"></i>
                            <p>Keranjang kosong</p>
                        </div>
                    `;
                updateTotal();
                return;
            }

            let html = '';
            for (let name in cart) {
                const item = cart[name];
                const product = productData[name] || { price: item.price, image: '' };

                html += `
                        <div class="cart-item" data-name="${name}">
                            <div class="item-info">
                                <div class="item-name">${name}</div>
                                <div class="item-price">Rp${item.price.toLocaleString('id-ID')}</div>
                                <div class="item-controls">
                                    <button class="qty-btn-checkout" onclick="decreaseItem('${name}')">−</button>
                                    <span class="qty-value-checkout">${item.qty}</span>
                                    <button class="qty-btn-checkout" onclick="increaseItem('${name}')">+</button>
                                    <button class="heart-btn-checkout" onclick="toggleHeart(this)">
                                    </button>
                                </div>
                            </div>
                            <img src="${product.image}" alt="${name}" class="item-image">
                        </div>
                    `;
            }

            container.innerHTML = html;
            updateTotal();
        }

        // Increase item quantity
        function increaseItem(name) {
            if (cart[name]) {
                cart[name].qty++;
                saveCart();
                renderCartItems();
            }
        }

        // Decrease item quantity
        function decreaseItem(name) {
            if (cart[name]) {
                cart[name].qty--;
                if (cart[name].qty <= 0) {
                    delete cart[name];
                }
                saveCart();
                renderCartItems();
            }
        }

        // Update total payment
        function updateTotal() {
            let total = 0;
            for (let name in cart) {
                total += cart[name].qty * cart[name].price;
            }

            const totalFormatted = `Rp${total.toLocaleString('id-ID')}`;
            document.getElementById('totalPayment').textContent = totalFormatted;
            document.getElementById('paymentTotal').textContent = totalFormatted;
        }

        // Save cart to localStorage
        function saveCart() {
            localStorage.setItem('seblakBundaCart', JSON.stringify(cart));
        }

        // Go back
        function goBack() {
            window.history.back();
        }

        // Add topping
        function addTopping() {
            window.location.href = '/'; // Redirect ke menu dengan scroll ke topping
        }

        // View details
        function viewDetails() {
            let details = 'Detail Pesanan:\n\n';
            for (let name in cart) {
                const itemTotal = cart[name].qty * cart[name].price;
                details += `${name} x${cart[name].qty} = Rp${itemTotal.toLocaleString('id-ID')}\n`;
            }
            alert(details);
        }

        // Place order
        function placeOrder() {
            const name = document.getElementById('customerName').value;
            const phone = document.getElementById('customerPhone').value;
            const spicyLevel = document.getElementById('spicyLevel').value;
            const orderType = document.getElementById('orderType').value;
            const paymentMethod = document.getElementById('paymentMethod').value;
            const note = document.getElementById('orderNote').value;

            // Validasi
            if (!name) {
                alert('Silakan isi nama pelanggan');
                return;
            }
            if (!phone) {
                alert('Silakan isi nomor telepon');
                return;
            }
            if (!spicyLevel) {
                alert('Silakan pilih level pedas');
                return;
            }
            if (!orderType) {
                alert('Silakan pilih Dine In atau Take Away');
                return;
            }
            if (Object.keys(cart).length === 0) {
                alert('Keranjang kosong');
                return;
            }

            // Validasi payment method untuk take away
            if (orderType === 'take-away' && paymentMethod !== 'qris') {
                alert('Untuk Take Away hanya bisa pembayaran QRIS');
                return;
            }

            // Siapkan data order
            const orderData = {
                customer: { name, phone },
                spicyLevel,
                orderType,
                paymentMethod,
                note,
                items: cart,
                total: Object.values(cart).reduce((sum, item) => sum + (item.qty * item.price), 0),
                status: paymentMethod === 'qris' ? 'pending_payment' : 'confirmed',
                createdAt: new Date().toISOString()
            };

            console.log('Order Data:', orderData);

            // Simpan order ke localStorage (untuk demo)
            localStorage.setItem('currentOrder', JSON.stringify(orderData));

            saveOrderToHistory(orderData);

            // Redirect ke halaman pembayaran
            if (paymentMethod === 'qris') {
                // Flow QRIS: Place Order → QRIS Page → Upload Bukti
                window.location.href = '/qrcode';
            } else {
                // Flow Cash: Place Order → Order Details → Check Status
                window.location.href = '/orderstatus';
            }
        }

        function saveOrderToHistory(orderData) {
            const orders = JSON.parse(localStorage.getItem('orderHistory') || '[]');
            orders.push(orderData);
            localStorage.setItem('orderHistory', JSON.stringify(orders));
        }
        // Initialize
        renderCartItems();
    </script>
@endpush