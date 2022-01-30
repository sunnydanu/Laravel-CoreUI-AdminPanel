@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Player
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>

                <tr>
                    <th>
                        Player
                    </th>
                    <td style="padding:  0;">
                        <img width="150" src="{{ url('/uploads/' . $player->player_img) }}" alt="">
                    </td>
                </tr>
                <tr>
                    <th>
                        Dob certificate
                    </th>
                    <td style="padding:  0;">
                        <a target="_blank" href="{{ url('/uploads/' . $player->dob_crt) }}"><img width="150" src="{{ url('/uploads/' . $player->dob_crt) }}" alt=""></a>
                    </td>
                </tr>
                <tr>
                    <th>
                        Player Id
                    </th>
                    <td>
                        {{ $player->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Full Name
                    </th>
                    <td>
                        {{ $player->full_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Father Name
                    </th>
                    <td>
                        {!! $player->father_name !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        Gender
                    </th>
                    <td>
                        {{ $player->gender }}
                    </td>
                </tr>
                <tr>
                    <th>
                        DOB
                    </th>
                    <td>
                        {{ $player->dob }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Category
                    </th>
                    <td>
                        {{ $player->category }}
                    </td>
                </tr>
                <tr>
                    <th>
                        District
                    </th>
                    <td>
                        {{ $player->district }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Pincode
                    </th>
                    <td>
                        {{ $player->pincode }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Phone
                    </th>
                    <td>
                        {{ $player->phone }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Email
                    </th>
                    <td>
                        {{ $player->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        District Approval
                    </th>
                    <td>
                        {{ $player->district_approval == 1 ? 'Yes' : 'No' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        State Approval
                    </th>
                    <td>
                        {{ $player->state_approval == 1 ? 'Yes' : 'No' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
