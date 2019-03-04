import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        username: null,
        tasks: []
    },
    getters: {
        username(state){
            return state.username;
        },
        tasks(state){
            return state.tasks;
        }
    },
    mutations: {
        GET_USER_NAME(state, payload){
            state.username = payload
        },
        GET_TASKS(state, payload){
            state.tasks = payload;
        },
        addTask(state, task){
            state.tasks.push(task);
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