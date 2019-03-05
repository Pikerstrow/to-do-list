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