   @extends('components.layouts.app')

   @section('title', 'Bem-vindo')

   @section('content')
       <style>
           body {
               background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
           }

           .card-hover:hover {
               transform: translateY(-5px);
               transition: 0.3s ease;
               box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
           }

           .icon-circle {
               width: 60px;
               height: 60px;
               display: flex;
               align-items: center;
               justify-content: center;
               border-radius: 50%;
               background: rgba(255, 255, 255, 0.1);
               margin-bottom: 15px;
           }
       </style>

       <div class="text-center text-white py-5">
           <h1 class="display-3 fw-bold mb-3">Bem-vindo ao Sistema</h1>
           <p class="lead mb-5">Gerencie suas tarefas, equipes e setores com praticidade e eficiência.</p>

           <div class="container">
               <div class="row g-4">
                   <!-- Usuários -->
                   <div class="col-md-4">
                       <div class="card bg-dark text-white border-success shadow-lg card-hover h-100 p-4">
                           <div class="icon-circle mx-auto">
                               <i class="bi bi-person-fill-check fs-3 text-success"></i>
                           </div>
                           <h4 class="text-center mb-2">Gestão de Usuários</h4>
                           <p class="text-center">Adicione, edite e gerencie os responsáveis pelas tarefas.</p>
                       </div>
                   </div>

                   <!-- Tarefas -->
                   <div class="col-md-4">
                       <div class="card bg-dark text-white border-primary shadow-lg card-hover h-100 p-4">
                           <div class="icon-circle mx-auto">
                               <i class="bi bi-list-task fs-3 text-primary"></i>
                           </div>
                           <h4 class="text-center mb-2">Controle de Tarefas</h4>
                           <p class="text-center">Crie tarefas, defina prazos e acompanhe o progresso.</p>
                       </div>
                   </div>

                   <!-- Setores -->
                   <div class="col-md-4">
                       <div class="card bg-dark text-white border-warning shadow-lg card-hover h-100 p-4">
                           <div class="icon-circle mx-auto">
                               <i class="bi bi-diagram-3-fill fs-3 text-warning"></i>
                           </div>
                           <h4 class="text-center mb-2">Organização por Setores</h4>
                           <p class="text-center">Classifique as tarefas por setor e otimize a produção.</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   @endsection
