@extends('layouts.admin')
@section('content')
    @can('player_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.players.create") }}">
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
                    <tr >
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
                    @foreach($players as $key => $player)
                        <tr data-entry-id="{{ $player->id }}">
                            <td style="padding:  0;">
                                <img width="150"   src="{{url('/uploads/'.$player->player_img)}}" alt="">
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
                                {{ $player->district_approval ?? '' }}
                            </td>
                            <td>
                                {{ $player->state_approval ?? '' }}
                            </td>
                            <td>
                                @can('player_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.players.show', $player->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('player_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.players.edit', $player->id) }}">
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
    @parent

@endsection
@endsection
