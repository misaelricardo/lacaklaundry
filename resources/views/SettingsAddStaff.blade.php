<!DOCTYPE html>
<html>

<head>
    <title>LacakLaundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('Image/logo1.png') }}" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/addstaffstyle.css') }}">
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <img class="sidebar-brand-picture" src="{{ asset('Image/logo.jpg') }}" alt="Profile Picture">
            <span class="brand-text">LacakLaundry</span>
        </div>
        <ul class="sidebar-nav">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/performance">Performance</a></li>
            <li><a href="/viewOrder">Orders</a></li>
            <div class="selected">
                <div class="sheet">
                    <li><a href="/settings">Settings</a></li>
                </div>
            </div>
        </ul>
    </div>

    <div class="container container-atas">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="profile-container">
                    <div class="left-container">
                        <a href="/settings/staff" style="text-decoration: none; color: black;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                <path
                                    d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                            </svg>
                        </a>
                        <span class="profile-text" href="/dashboard" style="font-weight:bold">Staff List</span>
                    </div>
                </div>

                <div class="container cont">
                    <form action="/settings/store" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:40px;">
                                <label for="labelsettings" class="col-sm-4 col-form-label custom-label">Photo
                                    Profile</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                        </div>


                        <div class="right-container">
                            <div class="form-group row" style="padding-top:40px;">
                                <label for="labelsettings" class="col-sm-4 col-form-label custom-label">First
                                    Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:40px;">
                                <label for="labelsettings" class="col-sm-4 col-form-label custom-label">Last
                                    Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="firstName">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:30px;">
                                <label for="labelsettings" class="col-sm-4 col-form-label custom-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:30px;">
                                <label for="labelsettings" class="col-sm-4 col-form-label custom-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:30px;">
                                <label for="password" class="col-sm-4 col-form-label custom-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">
                            <div class="form-group row" style="padding-top:30px;">
                                <label for="confirm_password" class="col-sm-4 col-form-label custom-label">Confirm
                                    Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="right-container">

                        </div>
                        <div class="overlap-group-1">
                            <button type="submit" class="button-label">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
