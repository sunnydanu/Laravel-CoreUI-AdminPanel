@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Tournament
        </div>

        <div class="card-body">
            <form action="{{ route("admin.tournaments.update", [$tournament->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="name">Title*</label>
                    <input type="text" id="title" name="title" class="form-control"
                           value="{{ old('title', isset($tournament) ? $tournament->title : '') }}">
                    @if($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </em>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                              class="form-control ">{{ old('description', isset($tournament) ? $tournament->description : '') }}</textarea>
                    @if($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
                    <label for="tag">Status<span class="text-danger">*</span></label>

                    <select id="tag" name="tag" class="form-control">

                        @php
                            $tournamentTag=['REG_OPEN' , 'REG_CLOSED',  'COMPLETED']
                        @endphp
                        @foreach($tournamentTag  as $tag)
                            <option
                                {{ (isset($tournament) && $tournament->tag === $tag) ? 'selected' : ''  }}
                                value="{{$tag}}">{{$tag}}</option>
                        @endforeach

                    </select>

                </div>

                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
        </div>
    </div>

@endsection
