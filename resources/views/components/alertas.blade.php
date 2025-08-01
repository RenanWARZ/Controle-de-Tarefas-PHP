 <!-- Mensagem de sucesso -->

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                   <strong> {{ session('success') }} </strong>
                </div>
            @endif


            @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                   <strong> {{ session('errors') }} </strong>
                </div>
            @endif
