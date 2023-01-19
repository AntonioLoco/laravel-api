@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <a href="{{ url()->previous() }}" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="text-center">Tutti i progetti con tecnologia {{ $technology->name }}</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Progetto</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technology->projects as $project)
                            <tr>
                                <th scope="row">{{ $project->title }}</th>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.projects.show', $project->slug) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <th scope="row">Nessun progetto</th>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @include('partials.delete-modal')
    </div>
@endsection
