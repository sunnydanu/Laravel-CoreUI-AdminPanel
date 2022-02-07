<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="{{ asset('css/bracket.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Girls Single</title>

</head>

<body>

@php
    $action = $draw->get('action');
    $detail = (object)['category_id'=>'','gender'=>''];
    $bracket = [];
        if($action ===  'view'){
            $detail = $draw->get('detail');
           $bracket  = $draw->get('detail')->bracket;
        }
@endphp
<form id="submit-draw" action="{{ route("admin.tournament.draw.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-12" style="display: flex; justify-content: space-around;
    margin-bottom: 55px;
    align-items:center">
        <input type="hidden" name="tournament_id" value="{{ $draw->get('tournament')}}">
        <input type="hidden" name="size" value="{{ $draw->get('size')}}">
        <input type="hidden" name="action" value="{{ $draw->get('action')}}">
        @if(request()->has('drawId'))
            <input type="hidden" name="drawId" value="{{ $detail->id}}">
        @endif

        <div class="form-group">
            <label for="draw-name" class="form-label">Name</label>
            <input required id="draw-name" name="name" type="text"
                   value="{{$detail->name??''}}"
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="category" class="form-label">Category*</label>

            <select id="category" required name="category_id" class="form-control">
                <option value="">Choose Category</option>
                @foreach($category_list  as $category)
                    <option
                        @if($detail->category_id === $category->code)
                        selected="selected"
                        @endif
                        value="{{$category->code}}">{{$category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="form-group">
            <label for="gender" class="form-label">Gender*</label>

            <select required id="gender" name="gender" class="form-control">
                <option value="">Choose gender</option>
                <option @if($detail->gender === 'men')
                        selected="selected"
                        @endif value="men">Men
                </option>
                <option @if($detail->gender === 'women')
                        selected="selected"
                        @endif value="women">Women
                </option>

            </select>
        </div>
        <div class="form-group">


            <button class="btn btn-success " style=" width: 130px;margin-top: 30px; "
                    id="submit" type="submit">
                {{ trans('global.save') }}</button>
        </div>
    </div>


    <p class="text-danger">
        To use auto search: Enter player Id and then add #
        e.g : 1007#
    </p>

    <hr style="width: 98%;">
    @include("draws.draw-".$draw->get('size'))

</form>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>

<script>

    $(function () {


        let action = `{{$draw->get('action')}}`;
        let bracket = {};
        console.log(action);
        if (action === 'view') {
            bracket = '<?=  json_encode($bracket) ?>';
            console.log(JSON.parse(bracket));
            bracket = JSON.parse(bracket);
        }

        const main = $('.main-wrap');

        // Add round input
        $('.round').each(function () {
            const round = this;
            const roundInput = $('<input/>', {type: 'hidden', name: `bracket[${round.id}]`, id: this.id});
            if (action === 'view') {
                $(roundInput, main).val(bracket[roundInput.id]);
            }
            $(this).prepend(roundInput);


            $('.ip-box  input', this).each(function () {
                const player = this;
                const playerId = `${round.id}-${player.id}`;
                $(this).attr({
                    'name': `bracket[${playerId}]`,
                    "data-pid": playerId
                });

                if (action === 'view') {
                    $(player, main).val(bracket[playerId]);
                }
            })
        });


        $('#draw-name').on('keyup', function (e) {
            //alert("key up");
            e.preventDefault();
            let str = $(this).val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            str = str.replace(/\W$/, '-').toLowerCase();
            $('#draw-name').val(str);
        });

        $('.round input').on('keyup', function (event) {
            //alert("key up");
            const elm = event.target;
            const keycode = (event.keyCode ? event.keyCode : event.which);
            console.log(keycode);
            if (keycode == 51) {
                event.preventDefault();
                $.ajax({
                    headers: {'x-csrf-token': '{{ csrf_token() }}'},
                    method: 'POST',
                    dataType: "json",
                    url: '{{route('admin.tournament.getPlayer')}}',
                    data: {pid: elm.value.replace("#", '')},
                    success: function (resp) {
                        console.log(resp);
                        if (resp.status === '1') {
                            $(elm).val(resp.playerCode);
                        } else {
                            $(elm).val('');
                            alert('Player not found')
                        }
                    }
                })

            }

        });


        $('form#submit-draw').submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            const form = $(this);
            const url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    if (data.status === '1') {
                        parent.location.reload();

                    }
                    console.log(data); // show response from the php script.
                }
            });


        });
    });

</script>
</body>

</html>
