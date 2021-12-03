@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.tournament.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.tournament.fields.name') }}
                    </th>
                    <td>
                        {{ $tournament->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.tournament.fields.description') }}
                    </th>
                    <td>
                        {!! $tournament->description !!}
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@endsection