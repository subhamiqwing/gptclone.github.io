<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Bootstrap demo</title>
    {{-- BOotstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: #13254c
        }

        ::-webkit-scrollbar-thumb {
            background-color: #061128
        }

    </style>
</head>
<body style="background-color: #05113b">
    <div>
        <div class="container-fluid d-flex p-2">
            <div class="ps-2" style="width:40px; height: 50px;font-size: 180%;">
                <i class="fa fa-angle-double-left text-white mt-2"></i>
            </div>
            <div style="width: 50px; height: 50px;">
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimg.freepik.com%2Fpremium-photo%2Fportrait-handsome-anime-boy-avatar-computer-graphic-background-2d-illustration_67092-1984.jpg%3Fw%3D2000&f=1&nofb=1&ipt=5684d1e0f79e94c4f8a7719beb84e5bb168c7d1530cc3116b437c9c59adbf5ad&ipo=images" alt="" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
            </div>
            <div class="text-white fw-bold ms-2 mt-2">
                Chatbot
            </div>
        </div>

        <div style="background: #061128; height: 2px;"></div>
        <div id="content-box" class="contianer-fluid p-2" style="height: calc(100vh - 130px);overflow-y:scroll">


        </div>
        <div class="container-fluid w-100 px-3 py-2 d-flex" style="background:#131f45;height:62px;">
            <div class="me-2 ps-2" style="background:#fff; width: calc(100% - 45px);border-radius:5px;">
                <input type="text" id="input" class="" type="text" name="input" style="background:none;width:100%;height: 100%;border: 0;outline:none;">
            </div>
            <div id="button-submit" class="text-center" style="background:#4acfee;height: 100%;width: 50px; line-height: 40px; font-size: 25px; border-radius: 5px;">
                <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-hieght:45px;"></i>
            </div>
        </div>
    </div>


    {{-- SCRIPT --}}
    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- bootstrap --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#button-submit').on('click', function() {
            var $value = $('#input').val();
            $('#content-box').append(`
                <div class="mb-2">
                    <div class="float-right px-3 py-2" style="width: 270px;background: #4acfee;border-radius: 10px;float: right;font-size:85%;">
                        ` + $value + `
                    </div>
                    <div style="clear:both;"></div>
                </div>
            `);

            $.ajax({
                type: "post"
                , url: "{{url('send')}}"
                , data: {
                    'input': $value
                }
                , success: function(data) {
                    $('#content-box').append(`
                        <div class="d-flex align-items-center mb-2">
                            <div class="mt-2" style="width: 45px;height:45px;">
                                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimg.freepik.com%2Fpremium-photo%2Fportrait-handsome-anime-boy-avatar-computer-graphic-background-2d-illustration_67092-1984.jpg%3Fw%3D2000&f=1&nofb=1&ipt=5684d1e0f79e94c4f8a7719beb84e5bb168c7d1530cc3116b437c9c59adbf5ad&ipo=images" alt="" class="w-100 h-100 rounded-circle" style ="object-fit: cover;">
                            </div>
                            <div class="text-white px-3 mx-2 py-2" style="width:270px;background:#13254b;border-radius: 10px;font-size: 85%;">` + data + `</div>
                        </div>
                    `);
                    $value = $('#input').val('');
                }
            });

        });

    </script>

</body>
</html>
