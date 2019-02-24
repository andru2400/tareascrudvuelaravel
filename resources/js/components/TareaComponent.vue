<template>

    <div class="card">       
        <div class="card-header">
            <h2 class="text-center">¿ Que tarea pendiente tienes ?</h2>
            <form action="" v-on:submit.prevent="createTarea">

                <div class="input-group">                                                
                    <input type="text" class="form-control input-sm" v-model="newTarea">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </span>
                </div> 

            </form>
            <hr>
            <ul class="list">
                <li v-for="(tarea,index) in tareas">
                    <div class="d-inline-block">
                        <small class="text-muted">
                            <em>{{ since(tarea.created_at) }}</em>
                        </small>
                        <input type="text" class="d-inline-block" v-if="identificadorEditar == true && editDescription[index]" v-model="editDescription[index]">
                        <p class="d-inline-block" v-else>{{ tarea.description }}</p>
    
                         <div class="d-inline-block">
                            <button class="btn btn-sm btn-danger d-inline-block" v-on:click="deleteTarea(tarea.id)">
                                Eliminar
                            </button>
                            <button class="btn btn-sm btn-primary d-inline-block" v-model="identificadorEditar" v-if="identificadorEditar == false" v-on:click="cambioEditar(tarea.description,index)">
                                Editar 
                            </button>
                            <button class="btn btn-sm btn-primary d-inline-block" v-model="identificadorEditar" v-if="identificadorEditar == true && editDescription[index]" v-on:click="actualizarTarea(tarea.id,index)">
                                Guardar
                            </button>
                            <button class="btn btn-sm btn-warning d-inline-block" v-model="identificadorEditar" v-if="identificadorEditar == true && editDescription[index]" v-on:click="cancelarActualizarTarea()">
                                Cancelar
                            </button>
                        </div>    

                    </div>                   
                </li>
            </ul>
        </div>

<!--  -->


<!--  -->

        <div class="card-body">
            
        </div>
    </div>    

</template>

<script>
    
    import moment from 'moment';
    import toastr from 'toastr';   
    moment.lang('es'); // viene con el moment, cambia idioma

    // import axios from 'axios' Creo que no hay necesidad.        

    export default {
    
        data() {
            return {
                tareas: [],
                newTarea:'',
                identificadorEditar: false,
                editDescription : []
            }
        },
        created: function(){
            this.getTareas();
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getTareas: function(){
                // $('#loadersModal').modal('toggle');
                var url = 'mis-tareas';
                axios.get(url).then(response => {
                    this.tareas = response.data
                     // $('#loadersModal').modal('toggle');
                });
            },
            createTarea: function(){
               
                var url = 'guardar-tareas';
                axios.post(url,{description: this.newTarea
                }).then(response => { // si hay una respuesta ok
                   
                    this.editDescription = [];
                    this.getTareas();
                    this.newIdea = '';                           
                    // toastr.success(response.data.message , 'EXITOSO', {timeOut: 55000})                     
                    this.identificadorEditar = false;
                    
                }).catch( error => { // si hay un error
                    toastr.error('Error',);
                });    
            },
            cambioEditar: function(tareaDescription,index){                
                this.identificadorEditar = false;                
                this.identificadorEditar = true;                
                this.editDescription[JSON.parse(index)] = tareaDescription;
            },
            actualizarTarea: function(id,index){
              
                this.identificadorEditar = false;

                var parametros = { description: this.editDescription[index] };
                var url = 'actualizar-tareas/'+id;
                axios.put(url,parametros).then(response => { // si hay una respuesta ok          
                  
                    this.editDescription = [];
                    this.getTareas();
                    this.newIdea = '';                        
                    // toastr.success( response.data.message , 'EXITOSO', {timeOut: 5000})                              
                }).catch( error => { // si hay un error
                    toastr.error('Error',);
                });    
            },
            cancelarActualizarTarea: function(){
                this.identificadorEditar = false;
                 this.editDescription = [];
            },
            deleteTarea: function(id){
               
                var message = "¿ seguro desea eliminar ?";
                var url = "eliminar-tareas/"+id;                
                axios.delete(url).then(response => { // si hay una respuesta ok
                  
                    this.editDescription = [];
                    this.getTareas();
                    this.newIdea = '';                          
                    // toastr.success(response.data.message, 'EXITOSO', {timeOut: 5000})                              
                    this.identificadorEditar = false;
                }).catch( error => { // si hay un error
                    toastr.error('Error',);
                });  
            },
            since:function(d){
                return moment(d).fromNow();
            }
        }
    }

</script>


