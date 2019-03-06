<template>
   <div class="row justify-content-center">
      <div class="col-12 admin-welcome">
         <h2 class="admin-welcome-h2">
            Редагування завдання завдання
         </h2>
         <hr>
      </div>
      <div class="col-12 col-sm-10 col-lg-8 col-xl-7">

         <div class="form-group">
            <label for="title">Назва завдання</label>
            <input v-model="task.title" :class="{'is-invalid': errors.title}" type="text" id="title"
                   class="form-control">
            <div v-if="errors.title" class="invalid-feedback">{{ errors.title }}</div>
         </div>

         <div class="form-group">
            <label for="description">Опис завдання</label>
            <input v-model="task.description" :class="{'is-invalid': errors.description}" type="text" id="description"
                   class="form-control">
            <div v-if="errors.description" class="invalid-feedback">{{ errors.description }}</div>
         </div>

         <div class="form-group">
            <label for="status">Статус завдання</label>
            <select v-model="task.status" :class="{'is-invalid': errors.status}" class="form-control" id="status">
               <option value="0">Не виконане</option>
               <option value="1">Виконане</option>
            </select>
            <div v-if="errors.status" class="invalid-feedback">{{ errors.status }}</div>
         </div>

         <div class="form-group">
            <label>Планова дата виконання завдання </label>
            <date-picker :class="{'is-invalid': errors.due_date}" v-model="task.due_date" :config="{format: 'YYYY-MM-DD', locale: 'uk'}"></date-picker>
            <div v-if="errors.due_date" class="invalid-feedback">{{ errors.due_date }}</div>
         </div>

         <div class="form-group mt-4">
            <button @click="updateTask()" class="btn btn-primary col-12">Редагувати</button>
         </div>

      </div>
   </div>
</template>

<script>
    // Import this component
    import datePicker from 'vue-bootstrap-datetimepicker';

    // Import date picker css
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        props: ['id'],
        data(){
            return {
                errors: {}
            }
        },
        computed: {
            task(){
                return this.$store.getters.taskForEditing
            }
        },
        methods: {
            updateTask(){
                axios.patch(
                    'http://to-do-list.test/tasks/' + this.task.id,
                    this.task
                ).then(
                    response => {
                        let updatedTask = response.data.task;
                        this.$store.commit('updateTasks', updatedTask);

                        /*notification with toastr*/
                        toastr.success(response.data.message);

                        this.$router.push('/tasks');
                    }
                ).catch(
                    error => {
                        if (error.response.data.errors.title) {
                            this.$set(this.errors, 'title', error.response.data.errors.title[0]);
                        }
                        if (error.response.data.errors.description) {
                            this.$set(this.errors, 'description', error.response.data.errors.description[0]);
                        }
                        if (error.response.data.errors.status) {
                            this.$set(this.errors, 'status', error.response.data.errors.status[0]);
                        }
                        if (error.response.data.errors.due_date) {
                            this.$set(this.errors, 'due_date', error.response.data.errors.due_date[0]);
                        }
                        console.log(this.errors)
                    }
                );
            }
        },
        mounted(){
            this.$store.dispatch('getTaskForEditing', this.$route.params.id);
        },
        components: {
            datePicker
        }

    }
</script>

<style scoped>

</style>