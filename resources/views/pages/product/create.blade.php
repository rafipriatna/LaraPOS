@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create New Product</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Create New Product
            </h2>
            <p class="section-lead">
                Halaman untuk menambahkan produk baru.
            </p>

            <div class="card">

                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger col-lg-3">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br/>
                                @endforeach    
                            </div>                
                        @endif

                        <div class="row">

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <img src="{{ url('assets/img/image_not_available.png') }}" class="rounded img-responsive" alt="..." width="100%" id="img-preview">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-image"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="photo" id="img-file">
                                            <label class="custom-file-label" id="img-name">Choose file</label>
                                          </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control currency" name="stock">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Harga Beli
                                    </label>
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <b>Rp</b>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control currency" name="purchase_price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Harga Jual
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <b>Rp</b>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control currency" name="selling_price">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('addon-script')
<script src="{{ url('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ url('js/my_cleave.js') }}"></script>
<script src="{{ url('js/image_upload.js') }}"></script>
@endsection
