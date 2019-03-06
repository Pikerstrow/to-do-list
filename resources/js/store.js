import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        username: null,
        tasks: [],
        taskForEditing: {}
    },
    getters: {
        username(state){
            return state.username;
        },
        tasks(state){
            return state.tasks;
        },
        taskForEditing(state){
            return state.taskForEditing;
        }
    },
    mutations: {
        GET_USER_NAME(state, payload){
            state.username = payload
        },
        GET_TASKS(state, payload){
            state.tasks = payload;
        },
        GET_TASK_FOR_EDITING(state, payload){
            state.taskForEditing = payload
        },
        addTask(state, task){
            state.tasks.unshift(task);
        },
        updateTasks(state, updatedTask){
            let index = state.tasks.findIndex(task => task.id == updatedTask.id);
            state.tasks[index] = updatedTask;
        },
        deleteTask(state, index){
            state.tasks.splice(index, 1);
        }
    },
    actions: {
        getUserName({commit}){
            axios.get('http://to-do-list.test/username').then(
                response => {
                    commit('GET_USER_NAME', response.data.username);
                }
            );
        },
        getTaskForEditing({commit}, id){
            axios.get('http://to-do-list.test/tasks/get-for-editing/' + id).then(
                response => {
                    commit('GET_TASK_FOR_EDITING', response.data.task);
                }
            );
        },
        getTasks({commit}){
            axios.get('http://to-do-list.test/tasks').then(
                response => {
                    commit('GET_TASKS', response.data.tasks);
                }
            ).catch(error => {
                console.log(error)
            });
        }
    }
});