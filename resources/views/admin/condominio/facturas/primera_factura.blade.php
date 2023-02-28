<x-el-cuji>
   
    <div>
        <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
            <div class="page-title pe-3">Primera Relación de Gastos</div>
        </div>    
        <div class="card">
            <div class="card-body">
                <form action="{{route('save_fact')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3 float-end">
                            <label for="mes" class="form-label" style="font-style: italic; font-weight: 700;">Mes</label>
                            <select class="form-select" name="mes">
                                @foreach ( $meses as $key => $mes)
                                     <option value="{{$key+1}}">{{$mes}}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="col-sm-3 float-start">
                            <label for="ano" class="form-label text-center" style="font-style: italic; font-weight: 700;">Año</label>
                            <select class="form-select" name="ano">
                                @foreach ( $anos as $ano)
                                     <option value="{{$ano}}">{{$ano}}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                        <label for="observa" class="form-label text-center" style="font-style: italic; font-weight: 700;
                        ">Pie de PDF</label>
                            <input type="hidden" name="observa" id="observa" value="{{$obs}}">
                            <textarea  id="editor" style="width: 100%">
                                {!! $obs !!}
                            </textarea>
                        </div>
                        <div class="col-sm-2"></div>

                    </div> 
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary px-5 float-end">Continuar</button>
                        </div>
                    </div>   
                </form>

            </div>
        </div>
    
        @push('scripts')
	        <script src="{{asset('assets/plugins/ckeditor5/ckeditor.js')}}"></script>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ), {
                        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                    } )
                    .then( editor => {
                        editor.model.document.on('change:data', () => {
                            $("#observa").val(editor.getData());
                        })
                    })
                    .catch( err => {
                        console.error( err.stack );
                    } );
            </script>
                    
        @endpush

    
    

    
    </div>
    
</x-el-cuji>