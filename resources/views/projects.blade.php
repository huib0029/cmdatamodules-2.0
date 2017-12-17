@extends('layouts.master')

@section('page-title')
 Zoekpagina
@endsection

@section('title')
 Zoek naar projecten of gebruik het tabel:
@endsection

@section('content')
    <div class="col-lg-4">
        <div class="form-group">
        <div class="input-group input-group-md">
            <div class="icon-addon addon-md">
                <input type="text" placeholder="Zoek naar projecten" class="form-control" @change="search()" v-model="query">
            </div>
            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="search()" v-if="!loading">Zoeken</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Zoeken...</button>
                        </span>
        </div>
    </div>
    </div>
    @if (count($projects) > 0)
        <table class="table table-striped table-hover small table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-1">Id</th>
                    <th class="col-sm-4">Naam</th>
                    <th class="col-sm-2">Competenties</th>
                    <th class="col-sm-2">Projectgrootte</th>
                    <th class="col-sm-2">Leverancier</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td class="table-text">{{ $project->id }}</td>
                    <td class="table-text">{{ $project->name }}</td>
                    <td class="table-text">{{ $project->competenties }}</td>
                    <td class="table-text">{{ $project->projectgrootte }}</td>
                    <td class="table-text">{{ $project->leverancier }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
    Er is geen projecten data
    @endif
@endsection

@section('scripts')
@endsection
