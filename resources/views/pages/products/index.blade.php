@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Products Page</h1>
      </div>

      <div class="section-body">
          <h2 class="section-title">
              Products List
          </h2>
          <p class="section-lead">
              Berisi daftar produk yang tersedia.
          </p>

          <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>                                 
                            <tr>
                                <th class="text-center">
                                #
                                </th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($items as $index => $item)
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->photo }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp. {{ $item->purchase_price}}</td>
                                    <td>Rp. {{ $item->selling_price }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                                    </td>
                                @empty
                                    
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
              </div>
          </div>

      </div>

    </section>
</div>
@endsection

@section('addon-script')
<script src="{{ url('assets/js/page/modules-datatables.js') }}"></script>
@endsection