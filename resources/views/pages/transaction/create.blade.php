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

            <form action="{{ route('transaction.store') }}" method="POST">
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
                                        <input type="text" class="form-control" value="{{ $transaction_code }}" name="transaction_code" readonly>
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
                                <h1 class="display-1">{{ number_format($total_price, 0,',','.') }}</h1>
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
                        <table class="table">
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
                                            <img src="{{ Storage::disk('public')->exists($item->product->photo) ? Storage::url($item->product->photo) : url('assets/img/image_not_available.png') }}"
                                            alt="Foto Produk" class="img-fluid rounded mt-1 mb-1" height="10px" width="80px" />
                                        </th>
                                        <th>{{ $item->product->name }}</th>
                                        <th>Rp. {{ number_format($item->product_price, 0,',','.') }}</th>
                                        <th>{{ $item->quantity }}</th>
                                        <th>Rp. {{ number_format($item->total_price, 0,',','.') }}</th>
                                        <th class="text-right">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-icon icon-left" data-toggle="modal" data-target="#editItem-{{ $item->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="#" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-icon icon-left btn-delete">
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

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Biaya Belanjaan
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="custom-select">
                                    <option selected="">Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sub Total</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control" value="180.000" readonly/>
                                </div>
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
                                    <div class="form-group">
                                        <label>Kode Promo <code>(Jika ada)</code></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                              <button class="btn btn-primary" type="button">Cek</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" readonly>
                                            <div class="input-group-append">
                                              <div class="input-group-text">%</div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
    
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Potongan Diskon</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Grand Total</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control" readonly/>
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
                                            <input type="text" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Kembalian</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                              <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-right">
                <button class="btn btn-primary">Buat Transaksi</button>
            </div>

        </div>
    </section>
</div>

@foreach ($items as $item)
    <div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('transaction.update', $item->id) }}" method="POST">
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
                            <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" required/>
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
<script src="{{ url('js/my_sweetalert.js')}}"></script>
@endsection