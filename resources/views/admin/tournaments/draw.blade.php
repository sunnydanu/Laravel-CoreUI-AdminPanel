@extends('layouts.admin')

@section('content')

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

    <div id="draw-section" class="card">
        <div class="card-header">
            <span class="btn btn-sm btn-warning"> {{  request()->tournament }}</span>
            Draw
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table id="player_in_tournament_tbl"
                           class=" text-capitalize table table-bordered table-striped table-hover datatable ">
                        <thead style="white-space: nowrap">
                        <tr>
                            <th></th>
                            <th> Draw Id</th>
                            <th> Name</th>
                            <th> Type</th>
                            <th> Result</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody>


                        @foreach ($tournament->draws as $key => $draw)
                            <tr data-entry-id="{{ $draw->id }}">
                                <td></td>

                                <td>  {{ $draw->id?? '' }}</td>
                                <td>  {{ $draw->name ?? '' }}</td>
                                <td>  {{ $draw->gender ?? '' }} {{ $draw->category_id ?? '' }}</td>

                                <td>
                                    {{ $draw->result ?? '' }}
                                </td>
                                <td>
                                    <span class="btn btn-success btn-xs load-draw"
                                          id="{{ $draw->id?? '' }}">View</span>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>

            @can('create_tournament_draw')
                <div id="draw-container" class="render">
                    <h2>Create New Draw</h2>
                    <div class="row mt-2">

                        <div class="col-md-12">
                            <form action="{{ route('player.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label col-md-3" style=" float: left;">Select Draw Length*</label>

                                    <select name="draw-length" class="form-control col-md-4 pull-left" id="draw-length">
                                        <option value="0">Select Draw</option>
                                        <option value="8">Draw 8</option>
                                        <option value="16">Draw 16</option>
                                        <option value="20">Draw 20</option>
                                        <option value="24">Draw 24</option>
                                        <option value="32">Draw 32</option>
                                        <option value="40">Draw 40</option>
                                        <option value="48">Draw 48</option>
                                        <option value="64">Draw 64</option>
                                        <option value="80">Draw 80</option>
                                        <option value="96">Draw 96</option>
                                        <option value="128">Draw 128</option>

                                    </select>
                                    <button name="submit"
                                            type="button" class="btn generate btn-block btn-success col-md-4"
                                            value="submit" style=" float: right;">Generate
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="tournament-bracket" style="display: none">
                                <iframe frameborder="0" scrolling="yes"
                                        style="display:block; width:100%; height:100vh;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            @endcan
        </div>
    </div>



@section('scripts')


    <script>

        $(function () {
            @can('create_tournament_draw')
            $('#draw-section .generate,#draw-section .load-draw').on('click', function () {
                let url = '{{ route("admin.tournament.render.draw") }}/?';

                if ($(this).hasClass('load-draw')) {
                    console.log('load-draw');
                    url += `drawId=${this.id}`;
                }
                if ($(this).hasClass('generate')) {
                    url += `size=${$('#draw-length').val()}&tournament={{ request()->tournament}}`;
                }
                $('.tournament-bracket').show().find('iframe').attr('src', `${url}`);
            });

                @endcan
            let dtButtonsTournamentPlayer = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            $('#player_in_tournament_tbl').DataTable({
                buttons: dtButtonsTournamentPlayer,
            });

        });
    </script>
    @parent

@endsection
@endsection
