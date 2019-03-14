<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Поточні завдання на {{ (this.$route.query.year && this.$route.query.month && this.$route.query.date) ? concreteDate : currentDate}}
            </h2>
            <hr>
         </div>
      </div>
      <div v-if="isLoaded" class="row justify-content-center">
         <div v-if="this.$route.query.cal" class="col-12 mb-2">
            <router-link to="/calendar" class="btn btn-primary btn-sm" tag="button" active-class="active" exact>
               <span class="i-wrap"><i class="fas fa-long-arrow-alt-left"></i></span>
               <span class="nav-a-text"> назад</span>
            </router-link>
         </div>
         <div class="col-12">
            <div v-if="tasks.length > 0" class="table-responsive">
               <table class="table table-bordered admin-news-table">
                  <thead>
                  <tr>
                     <th>№</th>
                     <th>Назва</th>
                     <th>Опис</th>
                     <th>Виконати</th>
                     <th>Статус</th>
                     <th>Дії</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(task, index) in tasks" :key="index" :class="task.status == 0 ? 'uncompleted' : 'completed'">
                     <td>{{ index + 1 }}</td>
                     <td>{{ task.title }}</td>
                     <td>{{ task.description }}</td>
                     <td>{{ task.due_date.split("-").reverse().join("-") }}</td>
                     <td :style="[task.status == 0 ? {'color':'red'} : {'color':'green'}]">{{ task.status == 0 ? "Не виконане" : 'Виконане' }}</td>
                     <td>
                        <a @click="changeStatus(index)" class="task-done" title="Змінити статус"><i class="fas fa-check"></i></a>

                        <router-link :to="'/tasks/edit/' + task.id" tag="a" class="task-edit" title="Редагувати" active-class="active" exact>
                          <i class="fas fa-pencil-alt"></i>
                        </router-link>

                        <a @click="deleteTask(index)" class="task-delete" title="Видалити"><i class="fas fa-times"></i></a>
                     </td>
                  </tr>
                  </tbody>
               </table>
            </div>

            <div v-else class="col-12 no-news-info-block d-flex justify-content-center align-items-center">
               <div class="text-center">
                  <i class="far fa-frown fa-8x"></i>
                  <br>
                  <h3>На {{ (this.$route.query.year && this.$route.query.month && this.$route.query.date) ? concreteDate : currentDate }} задачі відсутні</h3>
               </div>
            </div>

         </div>
      </div>
      <div v-else class="row justify-content-center">
         <div class="col-12 text-center preloader-container">
            <img src="../../images/preloader.gif">
         </div>
      </div>
   </div>
</template>

<script>

    export default {
        data(){
            return {
                toastr: toastr.options = {
                    "positionClass": 'toast-top-full-width'
                },
                previousRoute: ''
            }
        },
        computed:{
            tasks(){
                return this.$store.getters.tasks;
            },
            isLoaded(){
                return this.$store.getters.isTasksLoaded;
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
            },
            concreteDate(){
                let year = this.$route.query.year ? this.$route.query.year : '';
                let month = this.$route.query.month ? this.$route.query.month : '';
                let date = this.$route.query.date ? this.$route.query.date : '';

                let concreteDate = new Date(year, month, date);

                let options = {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit',
                    timezone: 'UTC+2'
                };
                return concreteDate.toLocaleString("UK-ua", options);
            }
        },
        methods: {
            getTasksByDate(){
                let year = this.$route.query.year ? this.$route.query.year : new Date().getFullYear();
                let month = this.$route.query.month ? this.$route.query.month : new Date().getMonth();
                let date = this.$route.query.date ? this.$route.query.date : new Date().getDate();
                month++;

                let requestDay = year + "-" + month + "-" + date;

                this.$store.dispatch('getTasks', requestDay);
            },
            changeStatus(index){
                let todaysTasks = this.tasks;
                let task = todaysTasks[index];

                /*Кщпіюємо обєкт в новий, для того, що оновити UI виключно після успішного запиту до БД*/
                let copiedTask = JSON.parse(JSON.stringify(task));

                if(copiedTask.status === 1){
                    copiedTask.status = 0;
                } else {
                    copiedTask.status = 1;
                }

                axios.patch(
                    'http://to-do-list.test/tasks/change-status/' + copiedTask.id,
                    copiedTask
                ).then(
                    response => {
                        this.tasks[index].status = response.data.task.status;

                        /*notification with toastr*/
                        toastr.success(response.data.message);
                    }
                ).catch(
                    error => {
                        console.log(error);
                    }
                );
            },
            deleteTask(index){
                let confirmBox = confirm('Ви дійсно бажаєте видалити завдання?');

                if(confirmBox == true){
                    let todaysTasks = this.tasks;
                    let task = todaysTasks[index];

                    axios.delete("http://to-do-list.test/tasks/" + task.id).then(
                        response=> {
                            this.$store.commit('deleteTask', index);

                            /*notification with toastr*/
                            toastr.success(response.data.message);
                        }
                    ).catch(error => {
                        console.log("delete failed");
                    });
                }
            }
        },
        beforeRouteLeave(to, from, next){
            if(this.$store.getters.isTasksLoaded){
                this.$store.commit('resetIsLoadedStatus', false);
                if(!this.$store.getters.isTasksLoaded){
                    next()
                }
            } else {
                next()
            }
        },
        created(){
            this.getTasksByDate();
        },
        beforeUpdate(){
            if(!this.$store.getters.isTasksLoaded){
                this.getTasksByDate();
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
   .preloader-container{
      height: 100%;
   }
   .uncompleted{
      background-color: #fbffbc;
   }
   .completed {
      text-decoration: line-through;
      background-color: lightgreen;
   }
</style>