@extends('admin.templates.default')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">User Detail</h3>
                </div>
                <div class="card-body pt-0">
                    <form class="form needs-validation mt-7" action="{{ route('user.update',$data) }}" method="post" id="modal_add_form" novalidate enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="row mb-7">
                            <div class="col-12 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Name</span>
                                </label>
                                <input class="form-control form-control-solid" placeholder="Enter a name" name="name" value="{{$data->name}}" required/>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Email</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Email tidak boleh sama"></i>
                                </label>
                                <input class="form-control form-control-solid" type="email" placeholder="Email" name="email" value="{{$data->email}}" required/>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Role</span>
                                </label>
                                <select name="current_team_id" data-control="select2"  data-placeholder="Pilih Role..." class="form-control form-control-solid" required>
                                    <option value="{{$data->current_team_id}}" selected>{{$data->currentteam->name}}</option>
                                    @foreach ($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Status</span>
                                </label>
                                <select name="active" data-control="select2" data-placeholder="Pilih Status..." class="form-control form-control-solid" required>
                                    @if ($data->active == 1)
                                        <option value="1" selected>Active</option>
                                        <option value="0">Non Active</option>
                                    @else
                                        <option value="1">Active</option>
                                        <option value="0" selected>Non Active</option>
                                    @endif

                                </select>
                            </div>
                            <div class="col-lg-6 mb-5">
                            </div>
                            <div class="col-lg-6 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span>Photo</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Optional"></i>
                                </label>
                                <div class="my-3 text-center">
                                    <img
                                        src="{{ asset('assets/media/misc/spinner.gif') }}"
                                        data-src="{{ asset($data->photo) }}"
                                        class="lozad rounded mw-100 "
                                        alt=""
                                    />
                                </div>
                                <input type="file" class="form-control form-control-solid" name="photo" placeholder="Photo" accept=".jpg,.jpeg,.png"/>
                                @isset($data->profile_photo_path)
                                    <div class="mt-1 text-end">
                                        <button class="btn btn-danger btn-sm mt-2"
                                            href="{{ route('delete-photo-user',$data->id) }}"
                                            id="delete"
                                            >
                                            Delete
                                        </button>
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('user.index') }}" class="btn btn-light me-3">Back</a>
                            <button type="submit" class="btn btn-primary" id="modal_form_submit">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="post" id="deletePhoto">
        @csrf
        @method("PUT")
        <input type="submit" value="Hapus" class="btn btn-danger" style="display: none">
    </form>


@endsection


@section('styles')

@endsection

@push('scripts')

    <script>
        var element = document.getElementById('menu-setting');
            element.classList.add('show');
        var element2 = document.getElementById('menu-setting-user');
            element2.classList.add('active');
    </script>
    <script>
        (() => {
        'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script>
        $('button#delete').on('click',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Apakah kamu yakin hapus data ini?',
                text: "Data yang sudah di hapus tidak bisa di Kembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!'
                }).then((result) => {
                    if (result.value) {
                        document.getElementById('deletePhoto').action = href;
                        document.getElementById('deletePhoto').submit();
                        Swal.fire(
                        'Terhapus!!',
                        'Data kamu berhasil di hapus',
                        'success'
                    )
                }
            })
        })
    </script>

@endpush