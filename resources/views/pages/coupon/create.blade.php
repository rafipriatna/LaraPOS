@extends('layouts.app')

@section('title', $title)

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
                Halaman untuk menambahkan kupon baru.
            </p>

            <div class="card">

                <form action="{{ route('coupon.store') }}" method="post">
                    @csrf
                    <div class="card-body">

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

                        <div class="row">

                            <div class="col-lg-6">
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
                                    <label>Kode Kupon</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control coupon"
                                        onkeyup="this.value = this.value.toUpperCase();" onkeypress="return event.charCode != 32"
                                        name="coupon_code" value="{{ old('coupon_code') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Expired</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-times"></i>
                                            </div>
                                        </div>
                                        <input type="date" name="expired" class="form-control" value="{{ old('expired') }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="status">
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                            <option value="1" {{ old('status') == 0 ? 'selected' : '' }}}>Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-percentage"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="discount"
                                        onKeyPress="if(this.value >= 100) return false;" value="{{ old('discount') }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="description" rows="10">{{ old('description') }}</textarea>
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
