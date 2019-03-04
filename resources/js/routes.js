import Home from './components/Home.vue';
import AddTask from './components/AddTask.vue';
import ViewTasks from "./components/ViewTasks.vue";

export const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/tasks/create', name: 'create_task', component: AddTask},
    {path: '/tasks', name: 'tasks', component: ViewTasks},
];