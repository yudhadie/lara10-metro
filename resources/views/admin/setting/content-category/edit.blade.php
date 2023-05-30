@extends('admin.templates.default')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-body pt-9">
                    <form class="form mt-7" action="{{ route('role-user.update',$data) }}" method="post" id="modal_form_form">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="d-flex flex-column fv-row">
                            <div class="row mb-7">
                                <div class="col-12 mb-5">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Name</span>
                                    </label>
                                    <input class="form-control form-control-solid" placeholder="Enter a name" name="name" value="{{$data->name}}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('role-user.index') }}" class="btn btn-light me-3">Back</a>
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
        document.getElementById('menu-setting').classList.add('show');
        document.getElementById('menu-setting-role-user').classList.add('active');
    </script>
    <script>
        const form = document.getElementById('modal_form_form');
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi nama!'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
        const submitButton = document.getElementById('modal_form_submit');
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        form.submit();
                    }
                });
            }
        });
    </script>

@endpush
