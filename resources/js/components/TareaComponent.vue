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
                        <p class="d-inline-block" v-if="identificadorEditar == false">{{ tarea.description }}</p>
                        <input type="text" class="d-inline-block" v-if="identificadorEditar == true" v-model="editDescription.index">
    
                         <div class="d-inline-block">
                            <button class="btn btn-sm btn-danger d-inline-block" v-on:click="deleteTarea(tarea.id)">
                                Eliminar
                            </button>
                            <button class="btn btn-sm btn-primary d-inline-block" v-model="identificadorEditar" v-if="identificadorEditar == false" v-on:click="cambioEditar()">
                                Editar 
                            </button>
                            <button class="btn btn-sm btn-primary d-inline-block" v-model="identificadorEditar" v-if="identificadorEditar == true" v-on:click="actualizarTarea(tarea.id)">
                                Guardar
                            </button>
                        </div>    

                    </div>                   
                </li>
            </ul>
        </div>
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
                editDescription : ''
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
                var url = 'mis-tareas';
                axios.get(url).then(response => {
                    this.tareas = response.data
                });
            },
            createTarea: function(){
                var url = 'guardar-tareas';
                axios.post(url,{description: this.newTarea
                }).then(response => { // si hay una respuesta ok
                    this.getTareas();
                    this.newIdea = '';
                    toastr.success('No hubo problemas al guardar.', 'EXITOSO', {timeOut: 95000})          
                }).catch( error => { // si hay un error
                    toastr.error('Error',);
                });    
            },
            cambioEditar: function(){
                this.identificadorEditar = true;
            },
            actualizarTarea: function(id){
                this.identificadorEditar = false;

                var parametros = { description: this.editDescription };
                var url = 'actualizar-tareas/'+id;
                axios.put(url,parametros).then(response => { // si hay una respuesta ok
                    this.getTareas();
                    this.newIdea = '';
                    toastr.success('No hubo problemas al guardar.', 'EXITOSO', {timeOut: 95000})          
                }).catch( error => { // si hay un error
                    toastr.error('Error',);
                });    
            },
            deleteTarea: function(id){
                var message = "¿ seguro desea eliminar ?";
                var url = "eliminar-tareas/"+id;
                alert(url);
                axios.delete(url).then(response => { // si hay una respuesta ok
                    this.getTareas();
                    this.newIdea = '';
                    toastr.success('No hubo problemas al Eliminar.', 'EXITOSO', {timeOut: 95000})          
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


