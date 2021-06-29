@extends('layouts.app')

@section('title', $title)

@section('addon-css')
<link rel="stylesheet" href="{{ url('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                {{ $title }}
            </h2>
            <p class="section-lead">
                Halaman untuk membuat transaksi baru.
            </p>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ $error }}
                </div>
            </div>
            @endforeach
            @endif

            <form action="{{ route('sale.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                Informasi
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $transactionCode }}" name="transaction_code" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ date('d/m/Y') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">

                        <div class="card">
                            <div class="card-header">
                                Produk
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-barcode"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="product_code" placeholder="Kode Produk" value="{{ old('product_code') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-signature"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="quantity" placeholder="Quantity" value="{{ old('quantity') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right" style="margin-bottom: -9px;">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="card card-block d-flex" style="height: 311px">
                            <div class="card-header">
                                Rp.
                            </div>
                            <div class="card-body text-center align-items-center d-flex justify-content-center">
                                <h1 class="display-1 priceDisplay">{{ number_format($subTotal, 0,',',',') }}</h1>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <div class="card">
                <div class="card-header">
                    Sales
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="saleTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"></th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $index => $item)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <th>
                                        <img src="{{ Storage::disk('public')->exists($item->product->photo) ? Storage::url($item->product->photo) : url('assets/img/image_not_available.png') }}" alt="Foto Produk" class="img-fluid rounded mt-1 mb-1" height="10px" width="80px" />
                                    </th>
                                    <th>{{ $item->product->name }}</th>
                                    <th>Rp. {{ number_format($item->product_price, 0,',',',') }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>Rp. {{ number_format($item->total_price, 0,',',',') }}</th>
                                    <th class="text-right">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-icon icon-left" data-toggle="modal" data-target="#editItem-{{ $item->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('sale.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-icon icon-left btn-delete" data-namaproduk="{{ $item->product->name }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada produk yang dibeli.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('sale.getCoupon') }}" method="post">
                                @csrf
                                <input type="hidden" name="transaction_code" value="{{ $transactionCode }}">
                                <div class="form-group">
                                    <label>Kupon <code>(Jika ada)</code></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="coupon_code" class="form-control" onkeyup="this.value = this.value.toUpperCase();" onkeypress="return event.charCode != 32" value="{{ session('coupon_code') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Cek</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('transaction.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaction_code" value="{{ $transactionCode }}" />
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="customer_id" class="custom-select">
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg">
                    <div class="card">
                        <div class="card-header">
                            Pembayaran
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="hidden" name="coupon_code" value="{{ session('coupon_code') }}" />
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="discount" class="form-control" value="{{ session('discount') ? session('discount') : '0' }}" readonly>
                                            <div class="input-group-append">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Potongan Diskon</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" name="discount_price" class="form-control currency" value="0" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Sub Total</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" name="sub_total" class="form-control currency" value="{{ $subTotal }}" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Grand Total</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" name="grand_total" class="form-control currency" value="{{ $subTotal }}" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <div class="form-group">
                                        <label>Dibayar</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" name="paid" class="form-control currency" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Kembalian</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" name="change" class="form-control currency" value="0" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary" id="createTransaction" disabled>Buat Transaksi</button>
            </div>
            </form>

        </div>
    </section>
</div>

@foreach ($items as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('sale.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="transaction_code" value="{{ $item->transaction_code }}">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item->product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" value="{{ $item->product->product_code }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" required />
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection

@section('addon-script')
<script src="{{ url('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ url('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ url('js/my_cleave.js') }}"></script>
<script src="{{ url('js/my_sweetalert.js')}}"></script>
<script>
    $(document).ready(function() {

        function currencyFormat(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        let discount = $('[name="discount"]').val();
        let discountPrice = $('[name="discount_price"]');
        let subTotal = $('[name="sub_total"]').val().replace(/,/g, '');
        let grandTotal = $('[name="grand_total"]');
        let paid = $('[name="paid"]');
        let change = $('[name="change"]');
        let priceDisplay = $('.priceDisplay');

        let sumDiscountPrice = subTotal * discount / 100;

        discountPrice.val(currencyFormat(sumDiscountPrice));
        grandTotal.val(currencyFormat(subTotal - sumDiscountPrice));
        priceDisplay.html(currencyFormat(subTotal - sumDiscountPrice));

        paid.on('input', function() {
            paidValue = paid.val().replace(/,/g, '');
            changeValue = paidValue - grandTotal.val().replace(/,/g, '');

            if (changeValue < 0) {
                change.val(0)
            } else {
                change.val(currencyFormat(changeValue));
            }

            if (paidValue >= (subTotal - sumDiscountPrice)) {
                $(':input[id="createTransaction"]').prop('disabled', false);
            } else {
                $(':input[id="createTransaction"]').prop('disabled', true);
            }
        });
    });
</script>
@endsection