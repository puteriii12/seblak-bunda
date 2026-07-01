@extends('layouts.order_user')
@section('content')
    <!-- Mobile Status Bar -->
    <div class="status-bar">
        <span>9:41</span>
        <div class="status-icons">
            <span>📶</span>
            <span>📡</span>
            <span>🔋</span>
        </div>
    </div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="/" class="home-btn">Home</a>
            <h1 class="title">Order History</h1>
        </div>

        <div class="content-wrapper">
            <!-- January Section (March dates) -->
            <div class="month-section">
                <div class="month-header">
                    <h2 class="month-name">January</h2>
                    <p class="order-count">2 Order</p>
                </div>
                
                <div class="orders-grid">
                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">2 Item</span>
                            <span class="order-date">18 Mar 2026</span>
                        </div>
                        <a href="/detail_pesanan" class="arrow-link" style="text-decoration: none; color: inherit; font-size: 1.2em; font-weight: bold;">
                            <span class="arrow">›</span>
                         </a> 
                    </div>

                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">2 Item</span>
                            <span class="order-date">18 Mar 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>
                </div>
            </div>

            <!-- February Section -->
            <div class="month-section">
                <div class="month-header">
                    <h2 class="month-name">February</h2>
                    <p class="order-count">2 Order</p>
                </div>
                
                <div class="orders-grid">
                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">2 Item</span>
                            <span class="order-date">18 Feb 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>

                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">2 Item</span>
                            <span class="order-date">17 Feb 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>
                </div>
            </div>

            <!-- January Section (January dates) -->
            <div class="month-section">
                <div class="month-header">
                    <h2 class="month-name">January</h2>
                    <p class="order-count">4 Order</p>
                </div>
                
                <div class="orders-grid">
                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">2 Item</span>
                            <span class="order-date">18 Jan 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>

                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">3 Item</span>
                            <span class="order-date">13 Jan 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>

                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">5 Item</span>
                            <span class="order-date">12 Jan 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>

                    <div class="order-card">
                        <div class="order-info">
                            <span class="item-count">4 Item</span>
                            <span class="order-date">10 Jan 2026</span>
                        </div>
                        <span class="arrow">›</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Home Indicator (Mobile only) -->
        <div class="home-indicator"></div>
    </div>
@endsection
@push('scripts')

    <script>
        // Add click interaction
        document.querySelectorAll('.order-card').forEach(card => {
            card.addEventListener('click', function() {
                // Add visual feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
                
                // You can add navigation logic here
                console.log('Order clicked:', this.querySelector('.order-date').textContent);
            });
        });

        // Home button interaction
        document.querySelector('.home-btn').addEventListener('click', function() {
            alert('Navigating to Home...');
        });
    </script>
@endpush
