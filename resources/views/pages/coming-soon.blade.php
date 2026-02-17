@extends('layouts.app')

@section('title', $pageTitle ?? 'Section en construction')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor"
                            class="bi bi-cone-striped text-warning mb-4" viewBox="0 0 16 16">
                            <path
                                d="m9.97 4.88.953 3.811C10.159 8.878 9.14 9 8 9s-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12m-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4s1.2-.036 1.725-.098m4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257z" />
                        </svg>

                        <h1 class="display-4 fw-bold mb-3">{{ $pageTitle ?? 'Section en construction' }}</h1>
                        <p class="lead text-muted mb-4">
                            Cette section est actuellement en cours de développement.
                            <br>Revenez bientôt pour découvrir nos nouveautés !
                        </p>

                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-house-door me-2" viewBox="0 0 16 16">
                                <path
                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                            </svg>
                            Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection