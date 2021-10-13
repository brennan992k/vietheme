<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
                toastr.error('{{ $error }}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
        @endforeach
    @endif
</script>