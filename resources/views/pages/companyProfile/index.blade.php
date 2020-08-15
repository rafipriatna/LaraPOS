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
                Informasi tentang toko.
            </p>

            <div class="card">
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
                <form action="{{ route('companyProfile.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Pratinjau Foto</label>
                                    <img src="{{ !is_null($item) ? Storage::url($item->image) : url('assets/img/image_not_available.png') }}"
                                    class="rounded img-responsive" alt="{{ !is_null($item) ? $item->name : 'Company image' }}" width="100%" id="img-preview">
                                </div>
                                <div class="form-group">
                                    <label class="float-right">
                                        <a href="#" data-toggle="tooltip" title="Klik untuk menghapus foto yang sudah dipilih" style="display:none" id="img-reset">
                                            <code class="text-right">Hapus Foto</code>
                                        </a>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-image"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="img-file">
                                            <label class="custom-file-label" id="img-name">Pilih Foto</label>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{ !is_null($item) ? $item->name : old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" cols="30" rows="10" class="form-control">{{ !is_null($item) ? $item->address : old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <textarea name="contact" cols="30" rows="10" class="form-control">{{ !is_null($item) ? $item->contact : old('contact') }}</textarea>
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
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ url('js/my_sweetalert.js')}}"></script>
<script src="{{ url('js/image_upload.js') }}"></script>
@endsection