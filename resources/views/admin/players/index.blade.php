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
    <div class="card">
        <div class="card-header">
            {{ trans('global.player.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" text-capitalize table table-bordered table-striped table-hover datatable">
                    <thead style="white-space: nowrap">
                        <tr>
                            <th width="10">

                            </th>
                            <th> Name</th>
                            <th> Father Name</th>
                            <th> gender</th>
                            <th> dob</th>
                            <th> category</th>
                            <th> district</th>
                            <th> pincode</th>
                            <th> phone</th>
                            <th> email</th>
                            <th> district-approval</th>
                            <th> state-approval</th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($players as $key => $player)

                            <tr data-entry-id="{{ $player->id }}">
                                <td style="padding:  0;">
                                    <img width="150" src="{{ url('/uploads/' . $player->player_img) }}" alt="">
                                </td>
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
                                    {{ $player->district ?? '' }}
                                </td>
                                <td>
                                    {{ $player->pincode ?? '' }}
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
                                                class="btn btn-danger btn-xs action">Pending</button>
                                        @else
                                            <span title="Waiting for approval" class="btn btn-info btn-xs">Waiting</span>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    @can('player_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.players.show', $player->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('player_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.players.edit', $player->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('player_delete')
                                        <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan
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
        $(function() {
            $('form.player_approval').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting via the browser
                var form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    error: function(jqXHR, textStatus, errorMessage) {
                        console.log(errorMessage); // Optional
                    },
                    success: function(data) {
                        $('button.action',form).text('Approved').removeClass('btn-danger').addClass('btn-success');
                    }
                }).done(function(data) {
                    // Optionally alert the user of success here...
                }).fail(function(data) {
                    // Optionally alert the user of an error here...
                });
            });
        });
    </script>
    @parent

@endsection
@endsection
