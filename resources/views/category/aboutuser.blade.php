<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src = "https://ajax.aspnetCDN.com/ajax/jQuery/jQuery-3.3.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-photo {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .user-photo img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #333;
        }

        .user-details {
            text-align: center;
        }

        .user-details h2 {
            margin: 0;
            color: #333;
        }

        .user-details p {
            margin: 5px 0;
            color: #666;
        }

        .message-form {
            max-width: 500px;
        }

        .message-form h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        button {
            width: 100%;
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>User Profile</h1>
                <div class="user-info">
                    <div class="user-photo mb-3">
                        <img src="user-photo1.jpg" alt="User Photo 1" class="img-thumbnail me-2">
                        <img src="user-photo2.jpg" alt="User Photo 2" class="img-thumbnail">
                    </div>
                    <div class="user-details">
                        <h2>John Doe</h2>
                        <p><strong>Position:</strong> Engineer Developer at Samarkand State University</p>
                        <p><strong>Education:</strong> Graduated in Computer Science from Tashkent University of Information Technologies, Samarkand branch, in June 2024</p>
                        <p><strong>Experience:</strong> Participated in ICPC tournament in 2021 and 2022, Multiple years of experience in Robocontest competitions</p>
                        <p><strong>Skills:</strong> PHP, Python, C++, Dart, JavaScript, Laravel, Django, MySQL, PostgreSQL, HTML, CSS</p>
                        <p><strong>Interests:</strong> Solving problems on Codeforces and Acmp, Game development, Algorithmic challenges</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-start">
                <div class="message-form" style="margin-top: 200px">
                    <div class="container" id="messages">
                        @foreach ($response as $item )
                        @if($user_id == $item['sending_user'])
                            <div class="mt-2" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-left: 30%; border-radius:5px">
                                <p style="padding:7px">{{$item['message']}}</p>
                            </div>
                        @else
                            <div class="" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-right: 30%; border-radius:5px">
                                <p style="padding:7px">{{$item['message']}}</p>
                            </div>
                        @endif
                        @endforeach
                        <!-- <div class="" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-right: 30%; border-radius:5px">
                            <p style="padding:7px"> salom</p>
                        </div> -->
                        <!-- <div class="mt-2" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-left: 30%; border-radius:5px">
                            <p style="padding:7px"> salom qandaysan nima gaplar</p>
                            
                        </div> -->
                    </div>
                    <form id="message-form" id="message_clean">
                        @csrf
                        <input type="hidden" name="recipient_user" value="{{ $id }}">
                        <div class="form-group text-center">
                            <textarea id="message" name="message" rows="3" required class="form-control mt-3" style="width: 350px;"></textarea>
                        </div>
                        <button type="submit" id="select" class="btn btn-primary mt-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            });

            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    method: "POST",
                    url: "{{route('message')}}",
                    data: {
                        message: $('#message').val(),
                        recipient_user: $('input[name="recipient_user"]').val()
                    },
                    success: function(data) {
                        $('#messages').empty();

                        data.forEach(function(item) {
                            if ('{{ $user_id }}' == item.sending_user) {
                                $('#messages').append(`
                                    <div class="mt-2" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-left: 30%; border-radius:5px">
                                        <p style="padding:7px">${item.message}</p>
                                    </div>
                                `);
                            } else {
                                $('#messages').append(`
                                    <div class="" style="border: 1px solid rgba(0, 0, 0, 0.1); margin-right: 30%; border-radius:5px">
                                        <p style="padding:7px">${item.message}</p>
                                    </div>
                                `);
                            }
                        // $('#message').empty();
                        $('#message').val('');
                        $('#message_clean').empty();

                        });

                        console.log(data);
                        
                    },
                    error: function(xhr, status, error) {
                        
                    }
                });
            });

        })
    </script>
</body>
</html>
