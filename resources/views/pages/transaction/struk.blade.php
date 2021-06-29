<style>
    @font-face {
        font-family: code128;
        src: url(../../barcode/code128.ttf);
    }

    hr.gaya1 {
        background-color: #fff;
        border-top: 2px dashed #8c8b8b;
    }

    hr.gaya2 {
        border: 0;
        height: 1px;
        background: #333;
        background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);
        background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);
        background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);
        background-image: -o-linear-gradient(left, #ccc, #333, #ccc);
    }

    tr.gaya3 {
        border-top: 1px dashed #8c8b8b;
    }

    fieldset.title {
        background: url(../../images/web/hr.png) repeat-x 0 0;
        border: 0;
        display: block;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 1px;
    }

    fieldset.title legend {
        padding: 5px 10px;
        background: #fff;
    }
</style>

<center>
    <strong>{{ $data['companyProfile']['name'] }}</strong><br/>
    {{ $data['companyProfile']['address'] }}<br/>
    {{ $data['companyProfile']['contact'] }}<br/>
</center>
<br/>
<fieldset class="title">
    <legend>STRUK</legend>
</fieldset>
<br/>

<table style="width:180%">
    <tr>
        <td>Tanggal</td>
        <td>{{ \Carbon\Carbon::create($data['date'])->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td>Petugas</td>
        <td>{{ $data['user'] }}</td>
    </tr>
    <tr>
        <td>Pelanggan</td>
        <td>{{ $customer->name }}</td>
    </tr>
</table>

<hr class="gaya2">
<table style="width:100%; text-align:left">
    <tr>
        <th></th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Harga</th>
    </tr>

    @foreach ($items as $index => $item)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rp. {{ number_format($item->product_price, 0,',',',') }}</td>
    </tr>
    @endforeach

    <tr>
        <td><b>Total</b></td>
        <td></td>
        <td></td>
        <td><b>Rp. {{ number_format($data['paid'], 0,',',',') }}</b></td>
    </tr>
</table>

<hr class="gaya1">
<table style="width:142%">
    <tr>
        <td>Diskon</td>  
        <td>{{ $data['discount'] }}%</td>
    </tr>
    <tr>
        <td>Subtotal</td>
        <td>Rp. {{ number_format($subTotal, 0,',',',') }}</td>
    </tr>
    <tr>
        <td>Grandtotal</td>
        <td>Rp. {{ number_format($data['grandTotal'], 0,',',',') }}</td>
    </tr>
    <tr>
        <td>Bayar</td>
        <td>Rp. {{ number_format($data['paid'], 0,',',',') }}</td>
    </tr>
    <tr>
        <td>Kembali</td>
        <td>Rp. {{ number_format($data['change'], 0,',',',') }}</td>
    </tr>
</table>
<hr class="gaya3">
<center>
Harga produk sudah termasuk PPN.
    <h5>Barang yang sudah dibeli tidak dapat dikembalikan.</h5>
</center>
