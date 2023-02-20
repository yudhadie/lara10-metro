<a href="{{ route('role-user.edit', $model) }}" class="btn btn-icon btn-active-light-warning w-30px h-30px me-3" title="Edit details">
    <i class="bi bi-pencil-square"></i>
</a>

@if ($model->active == 0)
    <button href="{{ route('role-user.destroy', $model) }}" class="btn btn-icon btn-active-light-danger w-30px h-30px me-3" id="delete" title="Delete">
        <i class="bi bi-trash3-fill"></i>
    </button>

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
                        document.getElementById('deleteForm').action = href;
                        document.getElementById('deleteForm').submit();
                        Swal.fire(
                        'Terhapus!!',
                        'Data kamu berhasil di hapus',
                        'success'
                    )
                }
            })
        })
    </script>
@endif

