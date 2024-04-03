@extends('components.main')
@section('title')
    Posts Page
@endsection
@section('content')
    {{-- <a href="{{route(" index"}}" class="btn btn-success">Add New Post></a> --}}
    <div class="container" style="margin-top: 100px">

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="d-flex mb-3 align-items-center justify-between gap-3">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ __('language.lang') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('language', 'ar') }}">AR</a></li>
                    <li><a class="dropdown-item" href="{{ route('language', 'en') }}">EN</a></li>
                </ul>
            </div>
            <a href="{{ route('create') }}" class="btn  btn-success">{{ __('language.Add New') }}</a>
        </div>
        {{-- <div class="col-md-5">
        <input type="text" id="ajax_search" placeholder="search here" class="form-control mb-2" name="search">
    </div> --}}
        <div class="ajax_search_result">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title Post</th>
                        <th scope="col">Description Post</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>
                                @isset($post->img)
                                    <img src="./uploads/{{ $post->img }}" alt="post image"
                                        style="width: 100px; height: auto;">
                                @endisset
                                {{-- <img src="{{ asset('uploads/' . $post->img) }}" alt="post image"
                                    style="width: 100px; height: 100px;"> --}}
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('destroy', $post->id) }}">Delete</a>
                                {{-- ////////////////////////////////////////////// or ['id' => $post->id] --}}
                                <a class="btn btn-primary" href="{{ route('edit', $post->id) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th class="text-center">Theres No Posts Comming From DB</th>
                        </tr>
                        {{-- <h4 class="text-center"></h4> --}}
                    @endforelse

                </tbody>
            </table>
        </div>

        {{ $posts->links() }}
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("input", "#ajax_search", function() {
                var ajax_search = $(this).val()
                jQuery.ajax({
                    url: {{ route('ajax_search') }},
                    type: "post",
                    dataType: "html",
                    cache: false,
                    data: {
                        ajax_search: ajax_search,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $(".ajax_search_result").html(data)
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            })
        })
    </script>
@endsection
