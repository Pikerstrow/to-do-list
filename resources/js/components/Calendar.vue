<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Календар
            </h2>
            <hr>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-12 col-sm-10">
            <div class="calendar-wrapper">
               <h3 class="text-center">{{ defaultMonth }}</h3>
               <hr>
               <table class="table">
                   <thead>
                   <tr>
                       <th class="text-center">Пн</th>
                       <th class="text-center">Вт</th>
                       <th class="text-center">Ср</th>
                       <th class="text-center">Чт</th>
                       <th class="text-center">Пт</th>
                       <th class="text-center">Сб</th>
                       <th class="text-center">Нд</th>
                   </tr>
                   </thead>
                   <tbody>

                   </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        data() {
            return {
                defaultMonth: this.getStartDateForTitle()
            }
        },
        methods: {
            getStartDateForTitle() {
                let today = new Date();
                let options = {
                    year: 'numeric',
                    month: 'long',
                    timezone: 'UTC+2'
                };
                return today.toLocaleString("UK-ua", options);
            },

        }
    }
</script>

<style scoped>
   .calendar-wrapper {
      width: 100%;
      border: 2px solid darkgreen;
      padding: 20px;
   }
</style>