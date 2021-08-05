@extends('layout')

@section('title')
Detail Lowongan
@endsection

@section('konteng')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Lowongan</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Detail Lowongan</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class=" row d-flex justify-content-center">
                <div class="col-md-12 ">
                    <img src="{{ asset('images/'.$low->foto_low) }}" class="container-fluid d-flex justify-content-center" alt="">
                </div>
                <div class="portfolio-info d-flex justify-content-center col-md-10">
                    <div class="row  icon-box card-list">
                        <div class="col-sm-3">
                            <img src="{{ asset('images/'.$low->foto_mitra) }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0">
                            <h3>{{ $low->nama_low }}</h3>
                            <ul class="list-unstyled ">
                                <span>
                                    <li class=" d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/building.svg') }}" alt="" style="height: 20px;width: 20px;"></span><span class="ml-3">{{ $low->mitra['nama_mitra'] }}</span></li>
                                </span>
                                <span>
                                    <li class="d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/placeholder.svg') }}" alt="" style="height: 20px;width: 20px;"></span><span class="ml-3">{{ $low->mitra->kabupaten['nama']}}</span></li>
                                </span>
                                <span>
                                    <li class="d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/filter.svg') }}" alt="" style="height: 20px;width: 20px;"></span><span class="ml-3">{{ $low->kategori['kategori'] }}</span></li>
                                </span>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container portfolio-info col-md-10">
                <div class=" m-lg-5 icon-box card-list">
                    <p><strong>Deskripsi Lowongan</strong></p>
                    <p>{{ $low->deskripsi_low }}</p>
                    <p><strong>No. Telepon</strong></p>
                    <p>{{ $low->telepon_low }}</p>
                    <p><strong>Jumlah Mahasiswa</strong></p>
                    <p>{{ $low->jumlah_mhs }} Mahasiswa/i</p>
                    <p><strong>Durasi Magang</strong></p>
                    <p>{{ $low->durasi }}</p>
                    <p><strong>Lokasi</strong></p>
                    <p>{{ $low->lokasi }}</p>
                    <form action="#" onsubmit="showAddress(this.address.value); return false">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="address" type="hidden" value="{{ $low->lokasi }}"/>
                                <button type="button" class="btn btn-primary" id="submit">Locate</button>
                                <p id="error-msg"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 the-map">
                                <iframe id="map-canvas" src="{{ $low->lokasi }}" allowfullscreen></iframe>
                            </div>
                        </div>             
                    </form>
                    <div>
                        <a href="{{ route('lowongan.apply', $low->id) }}">
                            <button type="submit" class="btn btn-primary" {{ $button }}> Apply</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<script>
var q = "";
var linkKey = "https://www.google.com/maps/embed/v1/search?key=AIzaSyBK73HewkhHBVVs9nI98-HY_N7cZM_kdjE" 
var zoom = 14;
var defaultLoc = "New York, NY"

//Get users geolocation
if (navigator.geolocation) {
    q = navigator.geolocation.getCurrentPosition(handleGetCurrentPosition, onError);

    function handleGetCurrentPosition(location) {
        location.coords.latitude;
        location.coords.longitude;
    }

    function onError() {
        q = defaultLoc;
    }
}

//Set initial map based on user geolocation or NY, NY
var srcContent = linkKey + "&q=" + q + "&zoom=" + zoom;
$("#map-canvas").attr("src", srcContent);

//Change map based on user input in textbox and a click or enter key submission. 
$(function () {
    $('#submit').on('keypress click', function (e) {
        if ($('#address').val().length === 0) {
            q = defaultLoc;
        }
        else {
            q = $('#address').val();
        }
        srcContent = linkKey + "&q=" + q + "&zoom=" + zoom;
        if (e.which === 13 || e.type === 'click') {
            $("#map-canvas").attr("src", srcContent);
        }
    });
});

$(document).ready(function () {
        $('#submit').click()
    })
</script>
@endsection

<!-- ======= Footer ======= -->