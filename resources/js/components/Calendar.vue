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
      <div v-if="isLoaded">
         <div class="row">
            <div class="col-12 mb-3">
               <span class="tasks-a">n</span> - кількість запланованих завдань на дату
            </div>
         </div>
         <div class="row justify-content-center mb-4">
            <div class="col-12">
               <div class="calendar-wrapper">
                  <h3 class="text-center">
                     <span class="month-switcher" @click="prevMonth()"> &lsaquo;&lsaquo; </span>
                     {{ defaultMonth }}
                     <span class="month-switcher" @click="nextMonth()"> &rsaquo;&rsaquo; </span>
                  </h3>
                  <hr>
                  <component v-bind:is="calendar"/>
               </div>
            </div>
         </div>
      </div>
      <div v-else class="row justify-content-center">
         <div class="col-12 text-center preloader-container align-self-center">
            <img src="../../images/preloader.gif">
         </div>
      </div>
   </div>
</template>

<script>

    export default {
        data() {
            return {
                month: new Date().getMonth(),
                year: new Date().getFullYear(),
                todaysDate: new Date().getDate(),
                todaysMonth: new Date().getMonth(),
                todaysYear: new Date().getFullYear(),
                monthTasksQuantities: [],
                isLoaded: false
            };
        },
        computed: {
            defaultMonth() {
                return this.getStartDateForTitle();
            },
            date() {
                return new Date(this.year, this.month);
            },
            calendar() {
                return {
                    template: this.buildCalendar()
                }
            }
        },
        methods: {
            getStartDateForTitle() {
                let options = {
                    year: "numeric",
                    month: "long",
                    timezone: "UTC+2"
                };
                return this.date.toLocaleString("UK-ua", options);
            },
            getDaysQuantityInMonth(year, month) {
                return new Date(year, month, 0).getDate();
            },
            nextMonth() {
                this.isLoaded = false;
                let currentMonth = this.month;

                if (currentMonth == 11) {
                    this.month = 0;
                    this.year++;
                    this.getTasksQuantityForCalendar(this.year, this.month);
                } else {
                    this.month++;
                    this.getTasksQuantityForCalendar(this.year, this.month);
                }
            },
            prevMonth() {
                this.isLoaded = false;
                let currentMonth = this.month;
                let prevMonth = null;

                if (currentMonth == 0) {
                    this.month = 11;
                    this.year--;
                    this.getTasksQuantityForCalendar(this.year, this.month);
                } else {
                    this.month--;
                    this.getTasksQuantityForCalendar(this.year, this.month);
                }
            },
            buildCalendar() {
                let daysQuantity = this.getDaysQuantityInMonth(this.year, this.month + 1);

                let previousMonthDaysQuantity = this.getDaysQuantityInMonth(
                    this.year,
                    this.month
                );

                let startDayOfMonth = this.getDayForLoop(
                    new Date(this.year, this.month, 1).getDay()
                );

                let end = 42; // 6 weeks * 7 days;

                let result = "<table class=\"table table-calendar\"><thead><tr>";
                    result += "<th class=\"text-center\">Пн</th><th class=\"text-center\">Вт</th>";
                    result += "<th class=\"text-center\">Ср</th><th class=\"text-center\">Чт</th>";
                    result += "<th class=\"text-center\">Пт</th><th class=\"text-center\">Сб</th>";
                    result += "<th class=\"text-center\">Нд</th></tr></thead>";
                    result += "<tbody><tr>"

                for (let i = 1; i <= end; i++) {
                    if (i < startDayOfMonth) {
                        result +=
                            "<td class='text-center day-not-exists'>" +
                            (previousMonthDaysQuantity - (startDayOfMonth - i - 1)) +
                            "</td>";
                    } else if (i - startDayOfMonth >= daysQuantity) {
                        if (i % 7 === 0) {
                            result +=
                                "<td class='text-center day-not-exists'>" +
                                (i - daysQuantity - startDayOfMonth + 1) +
                                "</td></tr><tr>";
                        } else {
                            result +=
                                "<td class='text-center day-not-exists'>" +
                                (i - daysQuantity - startDayOfMonth + 1) +
                                "</td>";
                        }
                    } else {
                        let delta = startDayOfMonth - 1; // because days counts from 1;
                        let dayOfWeek = new Date(this.year, this.month, i - delta).getDay();

                        if (dayOfWeek === 0) {
                            if (
                                this.month === this.todaysMonth &&
                                this.year === this.todaysYear &&
                                i - delta === this.todaysDate
                            ) {
                                if(this.monthTasksQuantities[(i - delta)]){
                                    result += '<td class="text-center day-exists current-date">' + (i - delta) + " |" +
                                              "<router-link class='tasks-a' to='/tasks/view?year=" + this.year + "&month=" + this.month + "&date=" + (i - delta) + "&cal=true" + "'>" + this.monthTasksQuantities[(i - delta)] + "</router-link>" +
                                              "</td></tr><tr>";
                                } else {
                                    result += '<td class="text-center day-exists current-date">' + (i - delta) + "</td></tr><tr>";
                                }
                            } else {
                                if(this.monthTasksQuantities[(i - delta)]){
                                    result += '<td class="text-center day-exists">' + (i - delta) + " |" +
                                        "<router-link class='tasks-a' to='/tasks/view?year=" + this.year + "&month=" + this.month + "&date=" + (i - delta) + "&cal=true" + "'>" + this.monthTasksQuantities[(i - delta)] + "</router-link>"
                                        + "</td></tr><tr>";
                                } else {
                                    result += '<td class="text-center day-exists">' + (i - delta) + "</td></tr><tr>";
                                }
                            }
                        } else {
                            if (
                                this.month === this.todaysMonth &&
                                this.year === this.todaysYear &&
                                i - delta === this.todaysDate
                            ) {
                                if(this.monthTasksQuantities[(i - delta)]){
                                    result += '<td class="text-center day-exists current-date">' + (i - delta) + " |" +
                                        "<router-link class='tasks-a' to='/tasks/view?year=" + this.year + "&month=" + this.month + "&date=" + (i - delta) + "&cal=true" + "'>" + this.monthTasksQuantities[(i - delta)] + "</router-link>" +
                                        "</td>";
                                } else {
                                    result += '<td class="text-center day-exists current-date">' + (i - delta) + "</td>";
                                }
                            } else {
                                if(this.monthTasksQuantities[(i - delta)]){
                                    result += '<td class="text-center day-exists">' + (i - delta)  + " |" +
                                        "<router-link class='tasks-a' to='/tasks/view?year=" + this.year + "&month=" + this.month + "&date=" + (i - delta) + "&cal=true" + "'>" + this.monthTasksQuantities[(i - delta)] + "</router-link>"
                                        + "</td>";
                                } else {
                                    result += '<td class="text-center day-exists">' + (i - delta) + "</td>";
                                }
                            }
                        }
                    }
                }

                result += "</tr></tbody></table>";
                return result;
            },
            getDayForLoop(num) {
                switch (num) {
                    case 0:
                        return 7;
                        break;
                    case 1:
                        return 1;
                        break;
                    case 2:
                        return 2;
                        break;
                    case 3:
                        return 3;
                        break;
                    case 4:
                        return 4;
                        break;
                    case 5:
                        return 5;
                        break;
                    case 6:
                        return 6;
                        break;
                }
            },
            getTasksQuantityForCalendar(year = this.year, month = this.month){
                axios.get(
                    'http://to-do-list.test/tasks/get-tasks-quantity-by-month/' + year + "/" + month
                ).then(
                    response => {
                        this.monthTasksQuantities = response.data.quantities;
                        this.isLoaded = true;
                    }
                ).catch(
                    error => {
                        console.log(error);
                    }
                );
            }
        },
        mounted(){
            this.getTasksQuantityForCalendar();
        }
    }
</script>

<style scoped>
   .table-calendar thead {
      background-color: grey;
      color: white;
      border: 2px solid grey;
   }
   .table-calendar thead th {
      border: 1px solid white;
   }
   .calendar-wrapper {
      width: 100%;
      border: 2px solid darkgreen;
      padding: 20px;
   }
</style>