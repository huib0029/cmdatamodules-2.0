@extends('layouts.master')

@section('page-title')
 Zoekpagina
@endsection

@section('title')
 Zoek naar projecten of gebruik het tabel:
@endsection

@section('content')
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
                <tr class="row-link" style="cursor: pointer;"
                    data-href="{{action('ProjectsController@show', ['id' => $project->id]) }}">
                    <td class="table-text">{{ $project->id }}</td>
                    <td class="table-text">{{ $project->name }}</td>
                    <td class="table-text">{{ $project->competenties }}</td>
                    <td class="table-text">{{ $project->projectgrootte }}</td>
                    <td class="table-text">{{ $project->leverancier }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
@endsection
