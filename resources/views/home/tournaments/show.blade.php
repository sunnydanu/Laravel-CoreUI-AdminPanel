@extends('layouts.app')
@section('content')

    <div class="card" id="tournament">
        <div class="card-header">
            {{ trans('global.tournament.title') }} Details
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
