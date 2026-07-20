@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="row">

    <!-- Daftar Barang -->
    <div class="col-md-7">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-box"></i>
                    Daftar Barang
                </h5>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>

                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($barang as $item)

                        <tr>

                            <td width="80">

                                @if($item->foto)

                                <img
                                    src="{{ asset('storage/'.$item->foto) }}"
                                    width="60"
                                    class="rounded">

                                @else

                                <img
                                    src="https://placehold.co/60x60?text=No+Image"
                                    class="rounded">

                                @endif

                            </td>

                            <td>

                                <strong>{{ $item->nama_barang }}</strong>

                                <br>

                                <small>
                                    {{ $item->kode_barang }}
                                </small>

                            </td>

                            <td>

                                Rp {{ number_format($item->harga_jual,0,',','.') }}

                            </td>

                            <td>

                                {{ $item->stok }}

                            </td>

                            <td>

                                <button
                                    type="button"
                                    class="btn btn-success btn-sm tambahBarang"

                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_barang }}"
                                    data-harga="{{ $item->harga_jual }}">

                                    <i class="bi bi-plus-circle"></i>

                                    Tambah

                                </button>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- Keranjang -->
    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="bi bi-cart"></i>

                    Keranjang

                </h5>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('transaksi.store') }}"
                    method="POST">

                    @csrf

                    <table
                        class="table table-bordered"
                        id="keranjang">

                        <thead>

                            <tr>

                                <th>Barang</th>
                                <th width="70">Qty</th>
                                <th>Subtotal</th>
                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                    <hr>

                    <h4>

                        Total :

                        <span id="totalText">

                            Rp 0

                        </span>

                    </h4>

                    <input
                        type="hidden"
                        name="total"
                        id="total">

                    <div class="mb-3">

                        <label>Bayar</label>

                        <input
                            type="number"
                            id="bayar"
                            name="bayar"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Kembalian</label>

                        <input
                            type="text"
                            id="kembalian"
                            class="form-control"
                            readonly>

                    </div>



                    <button
                    onclick="return confirm('Simpan transaksi ini?')"
                    class="btn btn-primary w-100">

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

let cart = [];

const tbody = document.querySelector("#keranjang tbody");

const totalText = document.getElementById("totalText");

const totalInput = document.getElementById("total");

const bayar = document.getElementById("bayar");

const kembalian = document.getElementById("kembalian");

document.querySelectorAll(".tambahBarang").forEach(btn=>{

    btn.addEventListener("click",function(){

        let id = this.dataset.id;

        let nama = this.dataset.nama;

        let harga = parseInt(this.dataset.harga);

        let index = cart.findIndex(item=>item.id==id);

        if(index>=0){

            cart[index].qty++;

        }else{

            cart.push({

                id:id,

                nama:nama,

                harga:harga,

                qty:1

            });

        }

        renderCart();

    });

});

function renderCart(){

    tbody.innerHTML="";

    let total=0;

    cart.forEach((item,index)=>{

        let subtotal=item.qty*item.harga;

        total+=subtotal;

        tbody.innerHTML+=`

<tr>

<td>

${item.nama}

<input
type="hidden"
name="barang_id[]"
value="${item.id}">

<input
type="hidden"
name="harga[]"
value="${item.harga}">

</td>

<td>

<input
type="number"
name="qty[]"
value="${item.qty}"
min="1"
class="form-control qty"

data-index="${index}">

</td>

<td>

Rp ${subtotal.toLocaleString('id-ID')}

</td>

<td>

<button
type="button"
class="btn btn-danger btn-sm hapus"

data-index="${index}">

X

</button>

</td>

</tr>

`;

    });

    totalText.innerHTML="Rp "+total.toLocaleString('id-ID');

    totalInput.value=total;

    hitungKembalian();

    pasangEvent();

}

function pasangEvent(){

document.querySelectorAll(".qty").forEach(input=>{

input.addEventListener("change",function(){

let i=this.dataset.index;

let qty = parseInt(this.value);

if (isNaN(qty) || qty < 1) {
    qty = 1;
}

cart[i].qty = qty;

renderCart();

});

});

document.querySelectorAll(".hapus").forEach(btn=>{

btn.addEventListener("click",function(){

let i=this.dataset.index;

cart.splice(i,1);

renderCart();

});

});

}

function hitungKembalian(){

let bayarValue=parseInt(bayar.value)||0;

let total=parseInt(totalInput.value)||0;

let kembali=bayarValue-total;

if(kembali<0){

kembalian.value="Kurang";

}else{

kembalian.value="Rp "+kembali.toLocaleString('id-ID');

}

}

bayar.addEventListener("keyup",function(){

hitungKembalian();

});

bayar.addEventListener("change",function(){

hitungKembalian();

});

document.querySelector("form").addEventListener("submit", function(e){

    if(cart.length == 0){

        alert("Keranjang masih kosong!");

        e.preventDefault();

    }

});

</script>

@endsection