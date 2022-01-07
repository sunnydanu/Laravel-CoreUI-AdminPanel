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
    <title>{{ $draw->name}}</title>

</head>

<body>

<style>


    .round-title {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 10px;
        border-bottom: solid 1px #eee;
    }

    .playerBox .top {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .playerBox .bottom {
        display: flex;
        border: solid 1px #000;
    }

    .playerBox {
        font-size: 12px;
        height: 38px;
    }

    .playerBox .top div {
        display: block;
        padding: 0px 5px 0px 5px;
        text-align: center;
        border: solid 1px #497be3;
        border-bottom: 0;
    }

    .playerBox .top .player_point {
        background: #17b155;
        color: #fff;
    }

    .playerBox .top .player_id {
        background: #CFDDFA;
    }

    .playerBox .bottom .s_no {
        background: #FF9933;
        text-align: center;
        width: 30px;
    }

    .playerBox .bottom .player_name {
        box-sizing: border-box;
        float: left;
        text-overflow: ellipsis;
        padding: 3px;
        width: 139px;
        white-space: nowrap;
        overflow: hidden;
        color: #fff;
        background: #4c4c66;
    }

    .playerBox .bottom .player_state {
        background-color: #EFCF2F;
        color: #000;
        text-align: center;
        box-sizing: border-box;
        width: 50px;
    }

    .eventheading {
        text-transform: uppercase;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #00a65a;
    }
</style>


<div class="eventheading">{{ $draw->name}}</div>
<hr style="width: 98%;">
@include("draws.draw-".$draw->size)



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>

<script>

    $(function () {
        let bracket = {};

        let size = '<?= $draw->size?>';
        bracket = '<?=  json_encode($draw->bracket) ?>';
        console.log(JSON.parse(bracket));
        bracket = JSON.parse(bracket);

        const main = $('.main-wrap');

        // Add round input
        const roundLength = $('.round').length;
        $('.round').each(function (ri) {
            const round = this;
            let roundName = `R/${ri+1}`;
            if (ri === roundLength - 3) {
                roundName = `QF`;


            } else if (ri === roundLength - 2) {
                roundName = `SF`;

            } else if (ri === roundLength - 1) {
                roundName = `FINAL`;

            }

            $(this).prepend(`<div class="round-title"><b>${roundName}</b><div/>`);

            $('.ip-box  input', this).each(function (pi) {

                const player = this;
                const playerId = `${round.id}-${player.id}`;

                let playerInfo = [];

                try {
                    playerInfo = bracket[playerId].match(/(?<=\[)[^\][]*(?=])/g);
                } catch (e) {
                    playerInfo = ['MABdhxw9E', 'DEMO USER', 'JAL', '3 - 0 (8,7,4)'];
                }

                const [id, name, state, score] = playerInfo;


                let s_no = player.id.match(/\d+/);

                let playerBox = $(`<div class="playerBox">
                                   <div class="top">
                                    <div class="player_point">${score}</div>
                                     <div class="player_id">${id}</div>
                                    </div>
                                    <div class="bottom">
                                    <div class="s_no">${s_no}</div><div title="${name}" class="player_name">${name}</div>
                                    <div class="player_state">${state}</div></div>
                                  </div>`);
                if (ri === 0) {

                    $('.player_point', playerBox).css('opacity', 0);
                } else {
                    $('.player_point', playerBox).css('opacity', 1);

                }
                $(this).replaceWith(playerBox);

            })
        });


    });

</script>
</body>

</html>
