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
                            <th style="width: 5px"> Name</th>
                            <th> Father Name</th>
                            <th> gender</th>
                            <th> dob</th>
                            <th> district</th>
                            <th> category</th>
                            <th> phone</th>
                            <th> email</th>

                        </tr>

                        </thead>
                        <tbody>


                        @foreach ($playersInTournament as $key => $player)
                            <tr data-entry-id="{{ $player->tournaments->first()->pivot->id }}">
                                <td></td>


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
                                    {{ $player->district ?? '' }}
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @if(!request()->has('tournament') ||  auth()->user()->hasRole('district'))

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
                            <th> district</th>
                            <th> category</th>
                            <th> phone</th>
                            <th> email</th>
                            <th> district-approval</th>
                            <th> state-approval</th>
                            @if(auth()->user()->hasRole('state'))
                                <th> IsPaid</th>
                            @endif
                            <th>In Tournament</th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach ($players as $key => $player)
                            {{--@if ($player->tournaments->pluck('id')->contains(request()->tournament))--}}
                            {{--@continue--}}
                            {{--@endif--}}
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
                                    {{ $player->district ?? '' }}
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
                                            <span title="Waiting for approval"
                                                  class="btn btn-info btn-xs">Waiting</span>
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
                                            <span title="Waiting for approval"
                                                  class="btn btn-info btn-xs">Waiting</span>
                                        @endif
                                    </form>
                                </td>
                                @if(auth()->user()->hasRole('state'))
                                    <td>
                                        <form class="player_is_paid"
                                              action="{{ route('admin.player.is_paid', $player->id) }}" method="POST">
                                            @csrf
                                            @if ($player->is_paid)
                                                <button type="submit" title="Click to unpaid"
                                                        class="btn btn-success btn-xs action">Paid
                                                </button>

                                            @else
                                                <button type="submit" title="Click to paid"
                                                        class="btn btn-danger btn-xs action">Un-paid
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                @endif
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
    @endif


@section('scripts')

    <script>
        $(function () {
            const tournamentReg = (new URLSearchParams(window.location.search)).has('tournament');
            const tournamentCode = (new URLSearchParams(window.location.search)).get('tournament');

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
            $('form.player_is_paid').submit(function (event) {
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
                        if ($('button.action', form).hasClass('btn-danger')) {
                            $('button.action', form).text('Paid').removeClass('btn-danger').addClass('btn-success');
                        } else {
                            $('button.action', form).text('un-paid').removeClass('btn-success').addClass('btn-danger');
                        }

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

                // select player gender
                dtButtonsPlayerList.push({
                    text: `<select id="gender" class="form-control">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>`,
                });


                // select player  category
                const categoryListTemplate = `<select id="category_id" name="category" class="form-control">
                            <option value="">Choose Category</option>
                            @foreach($category_list  as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                    </select>`
                dtButtonsPlayerList.push({
                    text: categoryListTemplate,
                });

                // Register Player button

                let addButtonTrans = 'Register Selected Player';
                let addButton = {
                    text: addButtonTrans,
                    url: "{{ route('admin.tournament.register') }}",
                    className: 'btn-success',
                    action: function (e, dt, node, config) {

                        const gender = $('#gender').val();
                        const category_id = $('#category_id').val();

                        if (gender.trim().length === 0) {
                            alert('select gender')
                            return
                        }
                        if (category_id.trim().length === 0) {
                            alert('select category under players will be played')
                            return
                        }
                        const playerForms = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                            return {
                                id: uuidv4(),
                                'player_id': $(entry).data('entry-id'),
                                "tournament_id": tournamentCode,
                                gender,
                                category_id,
                                "user_id": "{{auth()->id()}}",
                            }
                        });
                        console.log(playerForms)
                        if (playerForms.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')
                            return
                        }
                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                headers: {'x-csrf-token': _token},
                                method: 'POST',
                                url: config.url,
                                data: {playerForms},
                                success: function (resp) {
                                    alert('Player Registered Successfully')
                                }
                            }).done(function () {
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
                    url: "{{ route('admin.tournament.removePlayerFromTournament') }}",
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
