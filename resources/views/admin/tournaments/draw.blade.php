@extends('layouts.admin')

@section('content')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css"
          integrity="sha512-8QbEO8yS//4kwUDxGu/AS49R2nVILw83kYCtgxBYk+Uw0B9S4R0RgSwvhGLwMaZuYzhhR5ZHR9dA2cDgphRTgg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('css/bracket.css')}}">
@endsection
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
                    <th> Reg Id</th>
                    <th> Player Id</th>
                    <th> Name</th>
                    <th> Father Name</th>


                </tr>

                </thead>
                <tbody>


                @foreach ($playersInTournament as $key => $player)
                    <tr data-entry-id="{{ $player->tournaments->first()->pivot->id }}">
                        <td></td>

                        <td>  {{ $player->tournaments->first()->pivot->id?? '' }}</td>
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

<div class="card">
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
                        <th> Type</th>
                        <th> Result</th>
                        <th></th>
                    </tr>

                    </thead>
                    <tbody>


                    @foreach ($playersInTournament as $key => $player)
                        <tr data-entry-id="{{ $player->tournaments->first()->pivot->id }}">
                            <td></td>

                            <td>  {{ $player->tournaments->first()->pivot->id?? '' }}</td>
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
        <hr>
        <div id="draw-container" class="render">
            <h2>Create New Draw</h2>
            <div class="row mt-2">

                <div class="col-md-12">
                    <form action="{{ route('player.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label col-md-3" style="
    float: left;
">Select Draw Length*</label>
                            <input class="form-control col-md-4" id="draw-length" type="number" name="draw-length"
                                   required="" style="
    float: left;
">
                            <button name="submit"
                                    onclick="drawGenerate();" type="button" class="btn btn-block btn-success col-md-4"
                                    value="submit" style="
    float: right;
">Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="tournament-bracket" style="display: none">
                        <div id="playoff" class="graph-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.js"
            integrity="sha512-BgJKmxJA3rvUEa00GOdL9BJm5+lu6V7Gx2K0qWDitRi0trcA+kS/VYJuzlqlwGJ0eUeIopW4T9faczsg8hzE/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        const drawGenerate = () => {
            const drawLength = $('#draw-length').val();
            console.log(drawLength);
            if (drawLength > 0) {

                $('.tournament-bracket').show();
                var customData = {
                    teams: [],
                    results: []
                }
                for (let i = 0; i < drawLength; i++) {

                    customData.teams[i] = [{name: ""}, null];

                }
                $('div#playoff').bracket({
                    init: customData,
                    dir: 'lr',
                    teamWidth: 343,
                    scoreWidth: 20,
                    matchMargin: 50,
                    roundMargin: 32,
                    centerConnectors: true,
                    save: function () {
                    }, /* without save() labels are disabled */
                    decorator: {
                        edit: edit_fn,
                        render: render_fn
                    }
                })
            } else {
                $('.tournament-bracket').hide();
            }

            $(this).text('Re-generate')
        }


        /* Custom data objects passed as teams */


        /* Edit function is called when team label is clicked */
        function edit_fn(container, data, doneCb) {
            var input = $('<input type="text">')
            // input.val(data ? data.flag + ':' + data.name : '')
            input.val(data ? data.name : '')
            container.html(input)
            input.focus()
            input.blur(function () {
                var inputValue = input.val()
                if (inputValue.length === 0) {
                    doneCb(null); // Drop the team and replace with BYE
                } else {
                    // var flagAndName = inputValue.split(':') // Expects correct input
                    //  doneCb({flag: flagAndName[0], name: flagAndName[1]})
                    doneCb({name: inputValue})
                }
            })
        }

        /* Render function is called for each team label when data is changed, data
         * contains the data object given in init and belonging to this slot.
         *
         * 'state' is one of the following strings:
         * - empty-bye: No data or score and there won't team advancing to this place
         * - empty-tbd: No data or score yet. A team will advance here later
         * - entry-no-score: Data available, but no score given yet
         * - entry-default-win: Data available, score will never be given as opponent is BYE
         * - entry-complete: Data and score available
         */
        function render_fn(container, data, score, state) {
            switch (state) {
                case "empty-bye":
                    container.append("No team")
                    return;
                case "empty-tbd":
                    container.append("Upcoming")
                    return;

                case "entry-no-score":
                case "entry-default-win":
                case "entry-complete":
                    const name = data.name.replace(/\s+/g, '-').toUpperCase();
                    container.append(`<img width="20" src="https://avatars.dicebear.com/api/initials/${name}.svg"> `).append(data.name)
                    return;
            }
        }


        $(function () {
            let dtButtonsTournamentPlayer = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            $('#player_in_tournament_tbl').DataTable({
                buttons: dtButtonsTournamentPlayer,
            });

        });
    </script>
    @parent

@endsection
@endsection
