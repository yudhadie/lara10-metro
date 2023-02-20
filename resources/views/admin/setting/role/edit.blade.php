@extends('admin.templates.default')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">User Detail</h3>
                </div>
                <div class="card-body pt-0">
                    <form class="form needs-validation mt-7" action="{{ route('role-user.update',$data) }}" method="post" id="modal_add_form" novalidate>
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="row mb-7">
                            <div class="col-12 mb-5">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Name</span>
                                </label>
                                <input class="form-control form-control-solid" placeholder="Enter a name" name="name" value="{{$data->name}}" required/>
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

@endsection


@section('styles')

@endsection

@push('scripts')

    <script>
        var element = document.getElementById('menu-setting');
            element.classList.add('show');
        var element2 = document.getElementById('menu-setting-role-user');
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

@endpush
