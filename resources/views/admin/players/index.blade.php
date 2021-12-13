@extends('layouts.admin')
@section('content')
    @can('player_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.players.create') }}">
                    {{ trans('global.add') }} {{ trans('global.player.title_singular') }}
                </a>
            </div>
        </div>
    @endcan


    @if(request()->has('tournament'))

        <div id="tournamentPlayerCard" class="card">
            <div class="card-header">
                Registered PLayer In <span class="btn btn-sm btn-warning"> {{  request()->tournament }}</span>
                Tournament
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="player_in_tournament_tbl"
                           class=" text-capitalize table table-bordered table-striped table-hover datatable ">
                        <thead style="white-space: nowrap">
                        <tr>
                            <th></th>
                            <th> Player Id</th>
                            <th> Name</th>
                            <th> Father Name</th>


                        </tr>

                        </thead>
                        <tbody>


                        @foreach ($playersInTournament as $key => $player)
                            <tr data-entry-id="{{ $player->id }}">
                                <td></td>

                                <td>  {{ $player->id ?? '' }}</td>

                                <td>
                                    {{ $player->full_name ?? '' }}
                                </td>
                                <td>
                                    {{ $player->father_name ?? '' }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            {{ trans('global.player.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="player_list_tbl"
                       class=" text-capitalize table table-bordered table-striped table-hover datatable">
                    <thead style="white-space: nowrap">
                    <tr>
                        <th></th>
                        <th> Player Id</th>
                        <th style="width: 5px"> Name</th>
                        <th> Father Name</th>
                        <th> gender</th>
                        <th> dob</th>
                        <th> category</th>
                        <th> phone</th>
                        <th> email</th>
                        <th> district-approval</th>
                        <th> state-approval</th>
                        <th>In Tournament</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach ($players as $key => $player)
                        <tr data-entry-id="{{ $player->id }}">
                            <td>

                            </td>

                            <td>  {{ $player->id ?? '' }}</td>

                            <td>
                                {{ $player->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $player->father_name ?? '' }}
                            </td>
                            <td>
                                {{ $player->gender ?? '' }}
                            </td>
                            <td>
                                {{ $player->dob ?? '' }}
                            </td>
                            <td>
                                {{ $player->category ?? '' }}
                            </td>

                            <td>
                                {{ $player->phone ?? '' }}
                            </td>
                            <td>
                                {{ $player->email ?? '' }}
                            </td>
                            <td>
                                <form class="player_approval"
                                      action="{{ route('admin.player.approval', $player->id) }}" method="POST">
                                    @csrf

                                    @if ($player->district_approval)
                                        <span class="btn btn-success btn-xs ">Approved</span>
                                    @elseif (auth()->user()->hasRole('district'))
                                        <button type="submit" title="Click to verifiy"
                                                class="btn btn-danger btn-xs action">Pending
                                        </button>
                                    @else
                                        <span title="Waiting for approval" class="btn btn-info btn-xs">Waiting</span>
                                    @endif

                                </form>
                            </td>
                            <td>
                                <form class="player_approval"
                                      action="{{ route('admin.player.approval', $player->id) }}" method="POST">
                                    @csrf
                                    @if ($player->state_approval)
                                        <span class="btn btn-success btn-xs">Approved</span>
                                    @elseif (auth()->user()->hasRole('state'))
                                        <button type="submit" title="Click to verifiy"
                                                class="btn btn-danger btn-xs action">Pending
                                        </button>
                                    @else
                                        <span title="Waiting for approval" class="btn btn-info btn-xs">Waiting</span>
                                    @endif
                                </form>
                            </td>
                            <td>
                                @if(isset($player->tournaments))
                                    @foreach($player->tournaments as $tournament)
                                        <span id="{{$tournament->id}}"
                                              class="btn btn-xs btn-dark">{{$tournament->id}}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="action">
                                    @can('player_show')
                                        <a class="btn btn-xs btn-primary"
                                           href="{{ route('admin.players.show', $player->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @if(!request()->has('tournament'))
                                        @can('player_edit')
                                            <a class="btn btn-xs btn-info"
                                               href="{{ route('admin.players.edit', $player->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('player_delete')
                                            <form action="{{ route('admin.players.destroy', $player->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                  style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger"
                                                       value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan
                                    @endif
                                </div>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@section('scripts')

    <script>
        $(function () {
            const tournamentReg = (new URLSearchParams(window.location.search)).has('tournament');

            $('form.player_approval').submit(function (event) {
                event.preventDefault(); // Prevent the form from submitting via the browser
                var form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    error: function (jqXHR, textStatus, errorMessage) {
                        console.log(errorMessage); // Optional
                    },
                    success: function (data) {
                        $('button.action', form).text('Approved').removeClass('btn-danger').addClass('btn-success');
                    }
                }).done(function (data) {
                    // Optionally alert the user of success here...
                }).fail(function (data) {
                    // Optionally alert the user of an error here...
                });
            });


            let dtButtonsPlayerList = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            let dtButtonsTournamentPlayer = $.extend(true, [], $.fn.dataTable.defaults.buttons);

            // delete button

            @can('player_delete')
            if (!tournamentReg) {
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.players.massDestroy') }}",
                    className: 'btn-danger',
                    action: function (e, dt, node, config) {
                        const ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                headers: {'x-csrf-token': _token},
                                method: 'POST',
                                url: config.url,
                                data: {ids: ids, _method: 'DELETE'}
                            })
                                .done(function () {
                                    location.reload()
                                })
                        }
                    }
                };
                dtButtonsPlayerList.push(deleteButton)
            }
            @endcan

            // register tournament player
            @can('register_tournament_player')

            if (tournamentReg) {
                let addButtonTrans = 'Register Selected Player';
                let addButton = {
                    text: addButtonTrans,
                    url: "{{ route('admin.tournament.register') }}",
                    className: 'btn-success',
                    action: function (e, dt, node, config) {
                        const ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                            return $(entry).data('entry-id')
                        });
                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')
                            return
                        }
                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                headers: {'x-csrf-token': _token},
                                method: 'POST',
                                url: config.url,
                                data: {ids: ids, _method: 'POST'}
                            })
                                .done(function () {
                                    location.reload()
                                })
                        }
                    }
                };
                dtButtonsPlayerList.push(addButton);

                let removeButtonTrans = 'Remove Selected Player';
                let removeButton = {
                    text: removeButtonTrans,
                    title: 'Remove Player from tournament',
                    url: "{{ route('admin.tournament.register') }}",
                    className: 'btn-danger',
                    action: function (e, dt, node, config) {
                        const ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                            return $(entry).data('entry-id')
                        });
                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')
                            return
                        }
                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                headers: {'x-csrf-token': _token},
                                method: 'POST',
                                url: config.url,
                                data: {ids: ids, _method: 'POST'}
                            })
                                .done(function () {
                                    location.reload()
                                })
                        }
                    }
                };
                dtButtonsTournamentPlayer.push(removeButton);
            }

            @endcan



            $('#player_list_tbl').DataTable({
                buttons: dtButtonsPlayerList
            })
            $('#player_in_tournament_tbl').DataTable({
                buttons: dtButtonsTournamentPlayer,

            })
        });
    </script>
    @parent

@endsection
@endsection
