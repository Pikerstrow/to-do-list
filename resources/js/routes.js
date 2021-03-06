import Home from './components/Home.vue';
import AddTask from './components/AddTask.vue';
import ViewTasks from "./components/ViewTasks.vue";
import EditTask from "./components/EditTask.vue";
import Calendar from "./components/Calendar.vue";

export const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/tasks/create', name: 'create_task', component: AddTask},
    {path: '/tasks/view/today', name: 'todays_tasks', component: ViewTasks},
    {path: '/tasks/edit/:id', name: 'tasks_edit', component: EditTask, props: true},
    {path: '/calendar', name: 'calendar', component: Calendar},
    {path: '/tasks/view', name: 'tasks_by_date', component: ViewTasks},
    {path: '/*', redirect: '/'}
];