@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Lista delle tecnologie</h1>
        @if (session('message'))
            <div class="alert alert-success mt-5">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row mt-5">
            <div class="col-6">
                <form action="{{ route('admin.technologies.store') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Inserisci tecnologia" name="name">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Aggiungi</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tecnologia</th>
                            <th scope="col">N° Progetti</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <th scope="row">
                                    <form action="{{ route('admin.technologies.update', $technology->slug) }}"
                                        method="POST" id="edit-technologies-{{ $technology->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $technology->name }}"
                                            class="form-control">
                                    </form>
                                </th>
                                <td>{{ $technology->projects->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.technologies.show', $technology->slug) }}"
                                        class="btn btn-success">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="btn btn-warning" type="submit"
                                        form="edit-technologies-{{ $technology->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.technologies.destroy', $technology->slug) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn"
                                            data-project-title="{{ $technology->name }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('partials.delete-modal')
    </div>
@endsection
