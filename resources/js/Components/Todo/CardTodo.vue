<script>
import {ListTodoIcon} from "lucide-vue-next";

import TodoItem from "@/Components/Todo/TodoItem.vue";
import TodoList from "@/Components/Todo/TodoList.vue";
import TodoForm from "@/Components/Todo/TodoForm.vue";

import InputLabel from "@/Components/InputLabel.vue";
import AppButton from "@/Components/Button/AppButton.vue";

import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import HeightTransition from "@/Components/Transitions/HeightTransition.vue";

import {deleteCardTodo, getCardTodos, storeCardTodo, updateCardTodo, updateReorderedCardTodos} from "@/Api/card/todo.js";

export default {
    components: {
        ListTodoIcon,

        TodoForm,
        TodoList,
        TodoItem,

        InputLabel,
        AppButton,

        FadeTransition,
        HeightTransition,
        FadeInTransition
    },

    props: {
        cardId: {
            type: Number
        },
    },

    data() {
        return {
            cardTodos: [],

            showForm: false,
            isLoading: false,
            showReadyTodos: true
        }
    },

    mounted() {
        this.loadTodos()
    },

    methods: {
        openForm() {
            this.showForm = true;
        },

        closeForm() {
            this.showForm = false;
        },

        toggleShow() {
            this.showReady = !this.showReady;
        },

        loadTodos() {
            this.isLoading = true;

            getCardTodos(this.cardId)
                .then(todos => {
                    this.cardTodos = todos;

                    this.isLoading = false;
                });
        },

        onCreate(todo) {
            storeCardTodo(this.cardId, todo)
                .then(newTodo => {
                    this.cardTodos.push(newTodo)

                    this.closeForm()
                });
        },

        onTodoChecked({todo, cb: callback}) {
            updateCardTodo(todo.id, todo)
                .then(updatedTodo => {
                    const todo = this.cardTodos.find(item => item.id === updatedTodo.id);

                    if (todo) {
                        Object.assign(todo, updatedTodo)
                    }

                    if (callback) {
                        callback()
                    }
                });
        },

        onTodoDelete(todo) {
            deleteCardTodo(todo.id)
                .then(() => {
                    this.cardTodos = [...this.cardTodos.filter(item => item.id !== todo.id)]
                })
        },

        onReorderChange(todos) {
            updateReorderedCardTodos(this.cardId, todos)
        }
    }
}
</script>

<template>
    <fade-transition :is-group="true">
        <template v-if="!isLoading && cardTodos.length > 0 || showForm">
            <div class="mt-3">
                <div class="flex items-center gap-4 justify-between">
                    <input-label class="font-semibold !text-[18px] text-gray-800 dark:text-gray-200 flex items-start">
                        <list-todo-icon class="inline-block mr-2"/>

                        Todo
                    </input-label>

                    <a
                        href="#"
                        class="hover:underline"
                        @click.prevent="toggleShow"
                        v-text="showReadyTodos ? 'Hide ready items' : 'Show ready items'"
                    />
                </div>

                <fade-transition>
                    <div class="mt-2" v-if="cardTodos.length > 0">
                        <todo-list
                            :todos="cardTodos"
                            :show-ready-todos="showReadyTodos"
                            @todoDelete="onTodoDelete"
                            @todoChange="onTodoChecked"
                            @orderChange="onReorderChange"
                        />
                    </div>
                </fade-transition>
            </div>

            <fade-transition>
                <template v-if="showForm">
                    <div class="!mt-3">
                        <todo-form
                            :card-id="cardId"
                            @create="onCreate"
                            @close="closeForm"
                        />
                    </div>
                </template>
            </fade-transition>
        </template>
    </fade-transition>
</template>
