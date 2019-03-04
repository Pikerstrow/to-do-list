<template>
   <div class="row justify-content-center">
      <div class="col-12 admin-welcome">
         <h2 class="admin-welcome-h2">
            Створення нового завдання
         </h2>
         <hr>
      </div>
      <div class="col-12 col-sm-10 col-lg-8 col-xl-7">
         <div class="form-group">
            <label for="title">Назва</label>
            <input v-model="task.title" type="text" id="title" class="form-control">
         </div>

         <div class="form-group">
            <label for="description">Опис</label>
            <input v-model="task.description" type="text" id="description" class="form-control">
         </div>

         <div class="form-group">
            <button @click="createTask()" class="btn btn-primary col-12">Створити</button>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        data(){
            return {
                task: {
                    title: '',
                    description: ''
                },
                errors: [],
                toastr: toastr.options = {
                    "positionClass": 'toast-top-full-width'
               }
            }
        },
        methods: {
            createTask(){
                axios.post('http://to-do-list.test/tasks', {
                    title: this.task.title,
                    description: this.task.description
                }).then(response => {
                    this.$store.commit('addTask', response.data.task);
                    this.errors = [];
                    this.resetData();

                    /*notification with toastr*/
                    toastr.success(response.data.message);

                }).catch(error => {
                    if(error.response.data.errors.title){
                        this.errors.push(error.response.data.errors.title[0])
                    }
                    if(error.response.data.errors.description){
                        this.errors.push(error.response.data.errors.description[0])
                    }
                });
            },
            resetData(){
                this.task.title = '';
                this.task.description = '';
            }
        }
    }
</script>

<style scoped>

</style>