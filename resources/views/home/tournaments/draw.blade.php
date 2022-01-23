@extends('layouts.app')

@section('content')



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

                                    <a class="btn btn-xs btn-dark"
                                       href="{{ route('draw.view', ['drawId'=> $draw->id]) }}">
                                        Draw
                                    </a> &nbsp;


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>

        </div>
    </div>



@section('scripts')


    <script>

        $(function () {

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

        });
    </script>
    @parent

@endsection
@endsection
