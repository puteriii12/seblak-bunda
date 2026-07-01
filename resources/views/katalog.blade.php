@extends('layouts.main')

@section('title', 'Seblak Bunda - Menu')

@section('content')

    {{-- Header --}}
    <div class="app-header">
        <div class="header-top">
            <div>
                <div class="header-time"></div>
            </div>
            <div class="header-icons">
                <a href="/order_user" class="header-icon-link">
                    <i class="bi bi-receipt"></i>
                </a>
                <a href="{{ url('login') }}" class="header-icon-link">
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
        <div class="address-label">Your current address</div>
        <div class="current-address flex-grow-1" id="userAddress">
            <i class="bi bi-geo-alt-fill me-2"></i>
            <span id="addressText" class="address-label">Mendeteksi lokasi...</span>
        </div>
        <div class="search-bar">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="What would you like to eat?">
        </div>
    </div>

    {{-- Restaurant Info --}}
    <div class="restaurant-info">
        <h1 class="restaurant-name">Seblak Bunda</h1>
        <div class="restaurant-type">Warung Seblak</div>
        <div class="restaurant-location-row">
            <div class="restaurant-location">Banjarsari, Cangkringan, Sleman</div>
        </div>
        <div class="map-image">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1102.8817444666604!2d110.46739277704597!3d-7.647823568590191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5d005f4bbc05%3A0x8b1d579a46d344e5!2sSeblak%20Prasmanan%20Bunda!5e0!3m2!1sid!2sid!4v1781520547227!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <p class="description-text">
            Pilih menu favoritmu, atur level pedas, dan tambahkan topping sesuai selera dengan proses pemesanan yang mudah
            dan cepat.
        </p>
    </div>

    {{-- Category Tabs --}}
    <div class="category-tabs-container">
        <div class="category-tabs" id="categoryTabs">
            <button class="category-tab active" data-target="kerupuk">Kerupuk</button>
            <button class="category-tab" data-target="frozen-food">Frozen Food</button>
            <button class="category-tab" data-target="additional-topping">Additional Topping</button>
            <button class="category-tab" data-target="sayur">Sayur</button>
        </div>
    </div>

    {{-- Kerupuk Section --}}
    <div class="product-section" id="kerupuk">
        <h2 class="section-title">Kerupuk</h2>
        <div class="product-grid">
            <div class="product-card-grid">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiEOklV1QQzk87QXk7nzwPehBQgfRzBhnih6PkMP0pmNH-fYWgZIuoXWY&s=10"
                    alt="Kerupuk Orange" class="product-image">
                <div class="product-info">
                    <div class="product-name">Kerupuk Orange</div>
                    <div class="product-price">Rp1.000</div>
                    <button class="btn-add" onclick="addToCart(this, 'Kerupuk Orange', 1000)">Add</button>
                </div>
            </div>
            <div class="product-card-grid">
                <img src="https://down-id.img.susercontent.com/file/id-11134207-7ra0h-mdgomv5b22rw84" alt="Cikur"
                    class="product-image">
                <div class="product-info">
                    <div class="product-name">Cikur</div>
                    <div class="product-price">Rp1.000</div>
                    <button class="btn-add" onclick="addToCart(this, 'Cikur', 1000)">Add</button>
                </div>
            </div>
            <div class="product-card-grid">
                <img src="https://down-id.img.susercontent.com/file/06d421f23583ced3add8e4239109a8a9" alt="Siomay Kering"
                    class="product-image">
                <div class="product-info">
                    <div class="product-name">Siomay Kering</div>
                    <div class="product-price">Rp1.000</div>
                    <button class="btn-add" onclick="addToCart(this, 'Siomay Kering', 1000)">Add</button>
                </div>
            </div>
            <div class="product-card-grid">
                <img src="https://laz-img-sg.alicdn.com/p/b56f776be95dd776954908160a6ab819.jpg" alt="Cuanki"
                    class="product-image">
                <div class="product-info">
                    <div class="product-name">Cuanki</div>
                    <div class="product-price">Rp1.000</div>
                    <button class="btn-add" onclick="addToCart(this, 'Cuanki', 1000)">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Frozen Food Section --}}
    <div class="product-section" id="frozen-food">
        <h2 class="section-title">Frozen Food</h2>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Dumpling Keju</div>
                <div class="product-list-desc">Kulit kenyal isi keju leleh gurih.</div>
                <div class="product-list-price">Rp2.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Dumpling Keju', 2000)">Add</button>
            </div>
            <img src="https://down-id.img.susercontent.com/file/9ce501172d94079a11b20957d66ba0be" alt="Dumpling Keju"
                class="product-list-image">
        </div>

        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Bakso</div>
                <div class="product-list-desc"> Bola daging sapi kenyal dan lembut.</div>
                <div class="product-list-price">Rp1.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Bakso', 1000)">Add</button>
            </div>
            <img src="https://i0.wp.com/i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/7c4483e7-a99b-4887-ae8d-ab47e45a593f_Go-Biz_20211208_174356.jpeg"
                alt="Bakso" class="product-list-image">
        </div>

        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Crab Stick</div>
                <div class="product-list-desc">Olahan seafood manis gurih renyah.</div>
                <div class="product-list-price">Rp2.000</div>
                <div style="display: flex; align-items: center;">
                    <button class="btn-add" onclick="addToCart(this, 'Crab Stick', 2000)">Add</button>
                </div>
            </div>
            <img src="https://cdn.grid.id/crop/0x0:0x0/filters:format(webp):quality(100)/photo/2018/10/07/1210471840.jpg"
                alt="Crab Stick" class="product-list-image">
        </div>

        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Fish Roll</div>
                <div class="product-list-desc">Gulungan ikan lembut berbumbu.</div>
                <div class="product-list-price">Rp2.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Fish Roll', 2000)">Add</button>
            </div>
            <img src="https://pasarsegar.co.id/wp-content/uploads/2022/03/image_picker6751492691753706410-1.jpg"
                alt="Fish Roll" class="product-list-image">
        </div>
    </div>

    {{-- Additional Topping Section --}}
    <div class="product-section" id="additional-topping">
        <h2 class="section-title">Additional Topping</h2>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Ceker Ayam</div>
                <div class="product-list-desc">Ceker empuk bumbu meresap.</div>
                <div class="product-list-price">Rp2.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Ceker Ayam', 2000)">Add</button>
            </div>
            <img src="https://foto.kontan.co.id/pA0pw7S3rZfL3ZSeV1acZcaqhGc=/smart/filters:format(webp)/2023/04/09/1311779193.jpg"
                alt="Ceker Ayam" class="product-list-image">
        </div>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Tulang Rangu</div>
                <div class="product-list-desc">Tulang muda gurih mudah dimakan.</div>
                <div class="product-list-price">Rp3.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Tulang Rangu', 3000)">Add</button>
            </div>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_HbKCwA_4FfUDqbTOeEgEGd7Ss9mBBpDiJFpsBlaDOm4Melr6KIOBtZo&s=10"
                alt="Tulang Rangu" class="product-list-image">
        </div>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Telur Ayam</div>
                <div class="product-list-desc">Telur rebus lembut penambah protein.</div>
                <div class="sold-out-label">Menu habis terjual</div>
                <button class="btn-add" disabled>Add</button>
            </div>
            <img src="https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=200&h=200&fit=crop" alt="Telur Ayam"
                class="product-list-image">
        </div>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Telur Puyuh</div>
                <div class="product-list-desc">Telur puyuh mini kenyal gurih.</div>
                <div class="product-list-price">Rp2.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Telur Puyuh', 2000)">Add</button>
            </div>
            <img src="https://kareo-jawilan.desa.id/wp-content/uploads/2023/09/telur-puyuh.jpg" alt="Telur Puyuh"
                class="product-list-image">
        </div>
    </div>

    {{-- Sayur Section --}}
    <div class="product-section" id="sayur">
        <h2 class="section-title">Sayur</h2>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Sawi</div>
                <div class="product-list-desc">Sayur sawi segar pelengkap seblak.</div>
                <div class="product-list-price">Rp1.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Sawi', 1000)">Add</button>
            </div>
            <img src="https://i0.wp.com/resepkoki.id/wp-content/uploads/2018/02/sawi-hijau.jpg?fit=700%2C465&ssl=1"
                alt="Sawi" class="product-list-image">
        </div>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Kangkung</div>
                <div class="product-list-desc">Kangkung muda lembut kaya serat.</div>
                <div class="product-list-price">Rp1.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Kangkung', 1000)">Add</button>
            </div>
            <img src="https://puskesmasjakem-dikes.lombokbaratkab.go.id/media/crop/2025/02/11/59-20250211-083030-652715.jpg"
                alt="Kangkung" class="product-list-image">
        </div>
        <div class="product-list-item">
            <div class="product-list-info">
                <div class="product-list-name">Jamur Kuping</div>
                <div class="product-list-desc">Jamur kenyal menyerap bumbu sempurna.</div>
                <div class="product-list-price">Rp1.000</div>
                <button class="btn-add" onclick="addToCart(this, 'Jamur Kuping', 1000)">Add</button>
            </div>
            <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/e3bc6af4-f527-4ebb-91cd-ad3cfef04a84_Go-Biz_20230307_100902.jpeg"
                alt="Jamur Kuping" class="product-list-image">
        </div>
    </div>

    {{-- Cart Bar --}}
    <div class="cart-bar" id="cartBar" onclick="openCart()">
        <div class="cart-bar-left">
            <span class="cart-item-count" id="cartItemCount">0 Item</span>
            <span class="cart-total-price" id="cartTotalPrice">Rp0</span>
        </div>
        <div class="cart-bar-right">
            <i class="bi bi-chevron-right"></i>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function getUserLocation() {
            const addressText = document.getElementById('addressText');

            if (!navigator.geolocation) {
                addressText.textContent = 'Gunamarwan street No. 14';
                return;
            }

            addressText.textContent = 'Mendeteksi lokasi...';

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    reverseGeocode(position.coords.latitude, position.coords.longitude);
                },
                function (error) {
                    addressText.textContent = 'Gagal mendeteksi lokasi';
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 300000 }
            );
        }

        function reverseGeocode(lat, lon) {
            const addressText = document.getElementById('addressText');
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`;

            fetch(url, {
                headers: {
                    'Accept-Language': 'id'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        const address = data.address;
                        let shortAddress = '';
                        if (address.road || address.street) shortAddress += (address.road || address.street) + ', ';
                        if (address.suburb || address.village || address.neighbourhood) shortAddress += (address.suburb || address.village || address.neighbourhood) + ', ';
                        if (address.city_district || address.town) shortAddress += (address.city_district || address.town) + ', ';
                        if (address.city || address.county) shortAddress += (address.city || address.county);
                        if (!shortAddress) shortAddress = data.display_name;
                        if (shortAddress.length > 50) shortAddress = shortAddress.substring(0, 50) + '...';
                        addressText.textContent = shortAddress;
                        localStorage.setItem('user_lat', lat);
                        localStorage.setItem('user_lon', lon);
                        localStorage.setItem('user_address', shortAddress);
                        localStorage.setItem('location_timestamp', Date.now().toString());
                    } else {
                        addressText.textContent = 'Lokasi tidak ditemukan';
                    }
                    // HAPUS: refreshBtn.disabled = false;
                })
                .catch(error => {
                    console.error('Error geocoding:', error);
                    addressText.textContent = 'Gagal memuat alamat';
                    // HAPUS: refreshBtn.disabled = false;
                });
        }

        // HAPUS: document.getElementById('refreshLocation').addEventListener('click', getUserLocation);

        document.addEventListener('DOMContentLoaded', function () {
            const savedAddress = localStorage.getItem('user_address');
            const lastUpdate = localStorage.getItem('location_timestamp');
            const oneHour = 60 * 60 * 1000;

            if (savedAddress && lastUpdate && (Date.now() - parseInt(lastUpdate) < oneHour)) {
                document.getElementById('addressText').textContent = savedAddress;
            } else {
                getUserLocation();
            }
        });
        // Cart state - mulai dari object kosong
        let cart = {};

        // Category Tab Navigation
        const categoryTabs = document.querySelectorAll('.category-tab');
        const sections = document.querySelectorAll('.product-section');

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function () {
                categoryTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const targetId = this.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    const top = targetSection.getBoundingClientRect().top + window.pageYOffset - 200;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                }
            });
        });

        window.addEventListener('scroll', function () {
            let current = '';
            sections.forEach(section => {
                if (window.pageYOffset >= section.offsetTop - 250) {
                    current = section.getAttribute('id');
                }
            });
            categoryTabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.getAttribute('data-target') === current) {
                    tab.classList.add('active');
                }
            });
        });

        function addToCart(btn, name, price) {
            if (cart[name]) {
                cart[name].qty++;
            } else {
                cart[name] = { qty: 1, price: price };
            }

            btn.outerHTML = createQtyCounterHTML(name, cart[name].qty)
            saveCartToStorage();
            updateCartBar();
        }

        function increaseQty(btn, name) {
            const counter = btn.parentElement;
            const valueSpan = counter.querySelector('.qty-value');
            let value = parseInt(valueSpan.textContent) + 1;
            valueSpan.textContent = value;
            if (cart[name]) {
                cart[name].qty = value;
            } else {
                const listItem = counter.closest('.product-list-item') || counter.closest('.product-card-grid');
                const priceEl = listItem?.querySelector('.product-list-price, .product-price');
                const price = priceEl ? parseInt(priceEl.textContent.replace(/[^0-9]/g, '')) : 0;
                cart[name] = { qty: value, price: price };
            }
            saveCartToStorage();
            updateCartBar();
        }

        function decreaseQty(btn, name) {
            const counter = btn.parentElement;
            const valueSpan = counter.querySelector('.qty-value');
            let value = parseInt(valueSpan.textContent);

            if (value > 1) {
                value--;
                valueSpan.textContent = value;
                if (cart[name]) {
                    cart[name].qty = value;
                }
            } else {
                // Hapus dari cart
                delete cart[name];

                // Kembalikan ke tombol Add
                const listItem = counter.closest('.product-list-item') || counter.closest('.product-card-grid');
                const nameEl = listItem?.querySelector('.product-list-name, .product-name');
                const priceEl = listItem?.querySelector('.product-list-price, .product-price');
                const productName = nameEl ? nameEl.textContent : name;
                const price = priceEl ? parseInt(priceEl.textContent.replace(/[^0-9]/g, '')) : 0;

                const parentDiv = counter.parentElement;

                let addBtnHTML = `<button class="btn-add" onclick="addToCart(this, '${productName}', ${price})">Add</button>`;

                counter.outerHTML = addBtnHTML;
            }
            saveCartToStorage();
            updateCartBar();
        }

        function createQtyCounterHTML(name, qty) {
            return `
                                        <div class="qty-counter">
                                            <button class="qty-btn minus" onclick="decreaseQty(this, '${name}')">-</button>
                                            <span class="qty-value">${qty}</span>
                                            <button class="qty-btn plus" onclick="increaseQty(this, '${name}')">+</button>
                                        </div> `;
        }

        function updateCartBar() {
            const cartBar = document.getElementById('cartBar');
            const itemCountEl = document.getElementById('cartItemCount');
            const totalPriceEl = document.getElementById('cartTotalPrice');

            let totalItems = 0;
            let totalPrice = 0;

            for (let key in cart) {
                if (cart[key].qty > 0) {
                    totalItems += cart[key].qty;
                    totalPrice += cart[key].qty * cart[key].price;
                }
            }

            // Cart bar hanya muncul jika ada item
            if (totalItems > 0) {
                itemCountEl.textContent = `${totalItems} Item${totalItems > 1 ? 's' : ''}`;
                totalPriceEl.textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
                cartBar.classList.add('show');
            } else {
                cartBar.classList.remove('show');
                itemCountEl.textContent = '0 Item';
                totalPriceEl.textContent = 'Rp0';
            }
        }

        function syncDOMWithCart() {
            // Untuk setiap item di cart, cari produknya di DOM dan update tombolnya
            for (let name in cart) {
                const item = cart[name];

                // Cari semua tombol Add di halaman
                const allAddButtons = document.querySelectorAll('.btn-add');

                for (let btn of allAddButtons) {
                    // Cek onclick attribute untuk mendapatkan nama produk
                    const onclickAttr = btn.getAttribute('onclick') || '';
                    const match = onclickAttr.match(/addToCart\(this,\s*['"]([^'"]+)['"]/);

                    if (match && match[1] === name) {
                        // Produk ini ada di cart, ganti tombol Add dengan qty counter
                        btn.outerHTML = createQtyCounterHTML(name, item.qty);
                        break; // Found, stop searching
                    }
                }
            }
        }

        function saveCartToStorage() {
            localStorage.setItem('seblakBundaCart', JSON.stringify(cart));
        }

        // Fungsi baru: Buka cart (redirect ke checkout)
        function openCart() {
            window.location.href = '/checkout'; // Ganti dengan route Laravel kamu
        }

        // Load cart dari localStorage saat halaman dibuka
        window.addEventListener('load', function () {
            const savedCart = localStorage.getItem('seblakBundaCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                syncDOMWithCart();
                updateCartBar();
            }
        });
    </script>
@endpush