<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Поточні завдання на сьогодні ({{ currentDate }})
            </h2>
            <hr>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-12">
            <div v-if="tasks.length > 0" class="table-responsive">
               <table class="table table-bordered admin-news-table">
                  <thead>
                  <tr>
                     <th>№</th>
                     <th>Назва</th>
                     <th>Опис</th>
                     <th>Статус</th>
                     <th>Дії</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(task, index) in tasks" :key="index" :class="task.status == 0 ? 'uncompleted' : 'completed'">
                     <td>{{ index + 1 }}</td>
                     <td>{{ task.title }}</td>
                     <td>{{ task.description }}</td>
                     <td :style="[task.status == 0 ? {'color':'red'} : {'color':'green'}]">{{ task.status == 0 ? "Не виконане" : 'Виконане' }}</td>
                     <td>
                        <a class="task-done" title="Змінити статус"><i class="fas fa-check"></i></a>
                        <a class="task-edit" title="Редагувати"><i class="fas fa-pencil-alt"></i></a>
                        <a class="task-delete" title="Видалити"><i class="fas fa-times"></i></a>
                     </td>
                  </tr>
                  </tbody>
               </table>
            </div>

            <div v-else class="col-12 no-news-info-block d-flex justify-content-center align-items-center">
               <div class="text-center">
                  <i class="far fa-frown fa-8x"></i>
                  <br>
                  <h3>На сьогодні задачі відсутні</h3>
               </div>
            </div>

         </div>
      </div>
   </div>
</template>

<script>
    export default {
        computed:{
            tasks(){
                return this.$store.getters.tasks;
            },
            currentDate(){
                let today = new Date();
                let options = {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit',
                    timezone: 'UTC+2'
                };
                return today.toLocaleString("UK-ua", options);
            }
        }
    }
</script>

<style scoped>
   .task-done i {
      cursor: pointer;
      color: darkgreen;
      margin-right: 5px;
   }
   .task-edit i {
      cursor: pointer;
      color: royalblue;
      margin-right: 5px;
   }
   .task-delete i {
      cursor: pointer;
      color: darkred;
      margin-right: 5px;
   }
   .uncompleted{
      background-color: #fbffbc;
   }
   .completed {
      text-decoration: line-through;
      background-color: lightgreen;
   }
</style>