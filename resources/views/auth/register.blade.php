@php
    $data = \App\Models\StudentClass::all();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edubin - Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- app favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/vendors.css') }}" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/style.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/notyf@3.10.0/notyf.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-white">
    <div class="app">
        <div class="app-wrap">
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="{{ asset('admin_template/assets/img/loader/loader.svg') }}" alt="loader">
                    </div>
                </div>
            </div>

            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">

                            <!-- Left (Form Section) -->
                            <div class="col-sm-8 col-lg-7 col-xxl-5 align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="register p-5" style="max-width: 700px; margin: auto;">
                                        <p>Welcome, Please create your account.</p>
                                        <div class="card card-statistics">
                                            <div class="card-body">
                                                <div class="tab tab-border nav-center">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active show" id="home-tab"
                                                                data-toggle="tab" href="#home"
                                                                role="tab">Student</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="profile-tab" data-toggle="tab"
                                                                href="#profile" role="tab">Teacher</a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">

                                                        <!-- Student Register -->
                                                        <div class="tab-pane fade active show py-3" id="home"
                                                            role="tabpanel">
                                                            <p>Student Register</p>
                                                            <form method="POST"
                                                                action="{{ route('register.post', ['type' => 'student']) }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" placeholder="First name"
                                                                                value="{{ old('name') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Email*</label>
                                                                            <input type="email" class="form-control"
                                                                                name="email" placeholder="Your email"
                                                                                value="{{ old('email') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Class*</label>
                                                                            <select name="class" class="form-control">
                                                                                <option value="">---Select---
                                                                                </option>
                                                                                @foreach ($data as $d)
                                                                                    <option value="{{ $d->id }}">
                                                                                        {{ $d->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label">Password*</label>
                                                                            <input type="password" class="form-control"
                                                                                name="password"
                                                                                placeholder="Your password" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Confirm
                                                                                Password*</label>
                                                                            <input type="password" class="form-control"
                                                                                name="password_confirmation"
                                                                                placeholder="Your password" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" id="gridCheck">
                                                                            <label class="form-check-label"
                                                                                for="gridCheck">
                                                                                I accept terms & policy
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 mt-3">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Sign up</button>
                                                                    </div>

                                                                    <div class="col-12 mt-3">
                                                                        <p>Already have an account ? <a
                                                                                href="{{ route('login') }}">Sign In</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- Teacher Register -->
                                                        <div class="tab-pane fade py-3" id="profile"
                                                            role="tabpanel">
                                                            <p>Teacher Register</p>
                                                            <form method="POST"
                                                                action="{{ route('register.post', ['type' => 'teacher']) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name"
                                                                                placeholder="First name"
                                                                                value="{{ old('name') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Email*</label>
                                                                            <input type="email" class="form-control"
                                                                                name="email"
                                                                                placeholder="Your email"
                                                                                value="{{ old('email') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label">Password*</label>
                                                                            <input type="password"
                                                                                class="form-control" name="password"
                                                                                placeholder="Password" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Confirm
                                                                                Password*</label>
                                                                            <input type="password"
                                                                                class="form-control"
                                                                                name="password_confirmation"
                                                                                placeholder="Confirm password"
                                                                                required>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label><strong>Choose Subjects</strong></label>
                                                                            <select id="subjectDropdown" name="subject_ids[]" class="form-control select2" multiple>
                                                                                @foreach ($subjects->whereNull('parent_id') as $main)
                                                                                    @if ($main->subCategories->count())
                                                                                        <optgroup label="{{ $main->name }}">
                                                                                            @foreach ($main->subCategories as $sub)
                                                                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                                                            @endforeach
                                                                                        </optgroup>
                                                                                    @else
                                                                                        <optgroup label="Others">
                                                                                            <option value="{{ $main->id }}">{{ $main->name }}</option>
                                                                                        </optgroup>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label><strong>Choose
                                                                                    Subjects</strong></label>
                                                                            <select id="subjectDropdown"
                                                                                name="subject_ids[]"
                                                                                class="form-control select2" multiple>
                                                                                @foreach ($subjects->whereNull('parent_id') as $main)
                                                                                    <optgroup
                                                                                        label="{{ $main->name }}">
                                                                                        {{-- Include parent as selectable --}}
                                                                                        <option
                                                                                            value="{{ $main->id }}">
                                                                                            {{ $main->name }}
                                                                                        </option>

                                                                                        {{-- Include all subcategories --}}
                                                                                        @foreach ($main->subCategories as $sub)
                                                                                            <option
                                                                                                value="{{ $sub->id }}">
                                                                                                &nbsp;&nbsp;↳
                                                                                                {{ $sub->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </optgroup>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Document
                                                                                Upload*</label>
                                                                            <input type="file" name="document"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" id="gridCheck2">
                                                                            <label class="form-check-label"
                                                                                for="gridCheck2">
                                                                                I accept terms & policy
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 mt-3">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Sign up</button>
                                                                    </div>

                                                                    <div class="col-12 mt-3">
                                                                        <p>Already have an account ? <a
                                                                                href="{{ route('login') }}">Sign
                                                                                In</a></p>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end card -->
                                    </div>
                                </div>
                            </div>

                            <!-- Right (Image Section) -->
                            <div class="col-sm-4 col-xxl-7 col-lg-5 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto">
                                        <img class="img-fluid"
                                            src="{{ asset('admin_template/assets/img/bg/login.svg') }}"
                                            alt="login illustration">
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div> <!-- end container-fluid -->
                </div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="{{ asset('admin_template/assets/js/vendors.js') }}"></script>
    <script src="{{ asset('admin_template/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3.10.0/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#subjectDropdown').select2({
                placeholder: "Select subjects...",
                width: '100%'
            });
        });

        var notyf = new Notyf({
            duration: 6000,
            dismissible: true
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

</body>

</html>
