@extends('layouts.admin')
@section('content')
    @can('tournament_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tournaments.create') }}">
                    {{ trans('global.add') }} {{ trans('global.tournament.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('global.tournament.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" text-capitalize table table-bordered table-striped table-hover datatable">
                    <thead style="white-space: nowrap">
                        <tr>
                            <th width="10">

                            </th>
                            <th> Id</th>
                            <th> Title</th>
                            <th> Description</th>

                         
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tournaments as $key => $tournament)

                            <tr data-entry-id="{{ $tournament->id }}">
                               <td></td>
                                <td>
                                    {{ $tournament->title ?? '' }}
                                </td>
                                <td>
                                    {{ $tournament->description ?? '' }}
                                </td>
 


                                <td>
                                    @can('tournament_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.tournaments.show', $tournament->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('tournament_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.tournaments.edit', $tournament->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('tournament_delete')
                                        <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
            $('form.tournament_approval').submit(function(event) {
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
                        $('button.action', form).text('Approved').removeClass('btn-danger')
                            .addClass('btn-success');
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
