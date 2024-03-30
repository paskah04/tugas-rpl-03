@extends('frontend/layout/main')
@section('content')

    <section class="py-5 bg-light">
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-xl-8">
                    <h2 class="fw-bolder fs-5 mb-4">Most Views</h2>

                    @if($mostViews->isEmpty())
                        <p>No data available</p>
                    @else
                        @foreach($mostViews as $mv)
                            <div class="mb-4">
                                <div class="small text-muted">{{ $mv->kategori->nama_kategori }}</div>
                                <a class="link-dark" href="#!"><h3>{{ $mv->judul_berita }}</h3></a>
                            </div>
                        @endforeach
                    @endif

                    <div class="text-end mb-5 mb-xl-0">
                        <a class="text-decoration-none" href="{{ route('home.berita') }}">
                            More news
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex h-100 align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h6 fw-bolder">Contact</div>
                                    <p class="text-muted mb-4">
                                        For press inquiries, email us at
                                        <br/>
                                        <a href="#!">press@domain.com</a>
                                    </p>
                                    <div class="h6 fw-bolder">Follow us</div>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog preview section-->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder fs-5 mb-4">Featured Stories</h2>
            <div class="row gx-5">
                <!-- Your featured stories content goes here -->
            </div>
            <div class="text-end mb-5 mb-xl-0">
                <a class="text-decoration-none" href="#!">
                    More stories
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
